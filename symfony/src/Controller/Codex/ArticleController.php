<?php

namespace App\Controller\Codex;


use App\Entity\Article;
use App\Entity\User;
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
     * @Route("/codex/find", name="find")
     */
    public function find()
    {
        $repository= $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findBy(array(),array("dateInserted"=>"desc"));
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/codex/show/{id}", name="show")
     */
    public function show()
    {
        
    }
}
