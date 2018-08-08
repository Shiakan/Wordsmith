<?php

namespace App\Controller\Codex;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CodexController extends Controller
{
    /**
     * @Route("/codex", name="codex")
     */
    public function index()
    {
        $repository= $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findBy(array(),array("dateInserted"=>"desc"));
        return $this->render('codex/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
