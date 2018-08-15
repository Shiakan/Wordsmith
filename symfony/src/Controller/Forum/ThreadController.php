<?php

namespace App\Controller\Forum;

use App\Entity\Post;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Entity\Subcategory;
use App\Repository\ThreadRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/forum")
 */

class ThreadController extends Controller
{
    /**
     * @Route("/", name="thread_index", methods="GET")
     */
    public function index(ThreadRepository $threadRepository): Response
    {
        return $this->render('forum/thread/index.html.twig', ['threads' => $threadRepository->findAll()]);
    }

    /**
     * @Route("/thread/{subcategory_id}/new", name="thread_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user, $subcategory_id): Response
    {   
        $thread = new Thread();
        
        // On récupère la question à laquelle l'utilisateur a répondu
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $subcategory = $repository->findById($subcategory_id);
        $currentSubcategory = $subcategory[0];

        $form = $this->createForm(ThreadType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('thread');

            $title = $data['title'];
            $subtitle = $data['subtitle'];
            $content = $data['content'];

            $em = $this->getDoctrine()->getManager();

            $thread->setAuthor($user);
            $thread->setTitle($title);
            $thread->setSubcategory($currentSubcategory);
            $thread->setSubtitle($subtitle);

            $em->persist($thread);
            $em->flush();
            $this->createPost($thread, $content, $user);

            return $this->redirectToRoute('forum_index');
        }

        return $this->render('forum/thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
            'subcategory' => $currentSubcategory
        ]);
    }

    public function createPost($thread, $content, $user)
    {
        $post = new Post();

        $em = $this->getDoctrine()->getManager();
        $post->setThread($thread);
        $post->setContent($content);
        $post->setAuthor($user);
        $em->persist($post);
        $em->flush();

    }

    /**
     * @Route("/thread/{id}", name="thread_show", methods="GET")
     */
    public function show(Thread $thread): Response
    {
        return $this->render('forum/thread/show.html.twig', ['thread' => $thread]);
    }

    /**
     * @Route("/{id}/edit", name="thread_edit", methods="GET|POST")
     */
    public function edit(Request $request, Thread $thread): Response
    {
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('thread_edit', ['id' => $thread->getId()]);
        }

        return $this->render('forum/thread/edit.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="thread_delete", methods="DELETE")
     */
    public function delete(Request $request, Thread $thread): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thread->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($thread);
            $em->flush();
        }

        return $this->redirectToRoute('thread_index');
    }
}
