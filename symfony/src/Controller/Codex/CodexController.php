<?php

namespace App\Controller\Codex;

use App\Entity\Tag;
use App\Entity\Article;
use App\Form\SearchingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CodexController extends Controller
{
    /**
     * @Route("/codex", name="codex")
     */
    public function index(Request $request)
    {
        $repositoryArticle= $this->getDoctrine()->getRepository(Article::class);

        $repositoryTag= $this->getDoctrine()->getRepository(Tag::class);

        $tags = $repositoryTag->findByOrderId();

        $articles = $repositoryArticle->findLastSix();
        $form = $this->createForm(SearchingType::class);

        return $this->render('codex/index.html.twig', [
            'articles' => $articles,
            'tags'=>$tags,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/search", name="search_article")
     */
    public function findArticleBySearch(Request $request)
    {
        $data = $request->request->get('searching');
        $title = $data['title'];

        $repositoryArticle = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repositoryArticle->findBySearch($title);

        return $this->render('codex/article/search.html.twig', [
            'articles' =>$articles,
        ]);
    }
}
