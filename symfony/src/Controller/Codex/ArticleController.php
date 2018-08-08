<?php

namespace App\Controller\Codex;


use App\Entity\User;
use App\Entity\Article;
use App\Entity\Comment;
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
    public function show(Article $article, Request $request, ObjectManager $manager)
    {

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findAll();
        return $this->render('article/show.html.twig', [
            'article'=> $article,
            'comments'=>$comments
        ]);
    }
    
}
