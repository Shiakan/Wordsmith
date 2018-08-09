<?php

namespace App\Controller\Codex;

use App\Entity\Tag;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController
{
    /**
     * @Route("/show/tag/{id}", name="showByTag")
     */
    public function findArticlesByTag(Tag $tag)
    {
        $articles = $tag->getArticles();
        return $this->render('tag/index.html.twig', [
            'articles' =>$articles, 
            'tag'=>$tag,
        ]);
    }
}
