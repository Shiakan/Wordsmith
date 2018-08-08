<?php

namespace App\Controller\Codex;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @Route("/codex/find", name="show")
     */
    public function find()
    {
        $repository= $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

}
