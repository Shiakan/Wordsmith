<?php

namespace App\Controller\Codex;

use App\Entity\Tag;
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
        $repositoryArticle= $this->getDoctrine()->getRepository(Article::class);

        $repositoryTag= $this->getDoctrine()->getRepository(Tag::class);

        $tags = $repositoryTag->findByOrderId();

        $articles = $repositoryArticle->findLastFive();

        return $this->render('codex/index.html.twig', [
            'articles' => $articles,
            'tags'=>$tags,
        ]);
    }
}
