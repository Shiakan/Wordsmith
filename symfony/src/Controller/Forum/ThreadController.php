<?php

namespace App\Controller\Forum;

use App\Entity\Post;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Form\SubjectType;
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
        
        // On récupère la sous-catégorie dans laquelle l'utilisateur poste son sujet
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

            return $this->redirectToRoute('thread_show', [
                'id' => $thread->getId()
            ]);
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
    public function show(Thread $thread, Request $request): Response
    {   
        $form = $this->createForm(SubjectType::class, $thread);
        
        return $this->render('forum/thread/show.html.twig', [
            'thread' => $thread,
            'form' => $form->createView() ]);
    }

    /**
     * @Route("/thread/{id}/move", name="thread_move", methods="POST")
     */

    public function moveThread(Request $request, Thread $thread): Response 
    {
        
        $data = $request->request->get('subject');
        $subcategoryId = $data['subcategory'];

        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $subcategory = $repository ->findById($subcategoryId);
        $newSubcategory = $subcategory[0];

        $em = $this->getDoctrine()->getManager();
        $thread->setSubcategory($newSubcategory);
        $em->persist($thread);
        $em->flush();

        return $this->redirectToRoute('forum_subcategory', ['name' => $newSubcategory->getName()]);

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
}
