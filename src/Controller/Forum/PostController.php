<?php

namespace App\Controller\Forum;
use App\Entity\Post;
use App\Entity\Thread;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
     * @Route("/forum")
     */
class PostController extends Controller
{
    /**
     * @Route("/post/{thread_id}/new", name="post_new", methods="GET|POST")
     */
    public function new(Request $request, $thread_id, UserInterface $user=null): Response
    {
        $post = new Post();
        
        // On récupère la question à laquelle l'utilisateur a répondu
        $repositoryThread = $this->getDoctrine()->getRepository(Thread::class);
        $currentThread = $repositoryThread->findOneById($thread_id);
        
        $repositoryPost = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repositoryPost->findLastFive($currentThread);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        dump($currentThread->getSubcategory());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post->setThread($currentThread);
            $post->setSubcategory($currentThread->getSubcategory());
            $post->setAuthor($user);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('thread_show', [
                'id' => $currentThread->getId()
            ]);
        }
        return $this->render('forum/post/new.html.twig', [
            'thread' => $currentThread,
            'post' => $post,
            'posts' => $posts,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/post/{id}/edit", name="post_edit", methods="GET|POST")
     */
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('thread_show', ['id' => $post->getThread()->getId()]);
        }
        return $this->render('forum/post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}