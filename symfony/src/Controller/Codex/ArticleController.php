<?php

namespace App\Controller\Codex;


use App\Entity\User;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @Route("/codex/show/{id}", name="show")
     */
    public function show(Article $article, Request $request, ObjectManager $manager, UserInterface $user=null)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class , $comment);
        $form->handleRequest($request);
        $comment->setAuthor($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setArticle($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('show',['id'=>$article->getId()]);
        }
        return $this->render('article/show.html.twig', [
            'article'=> $article,
            'form' => $form->createView(),
        ]); 
    }
    
}
