<?php

namespace App\Controller\Backend\Codex;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/codex/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name="backend_article_index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('backend/codex/article/index.html.twig', ['articles' => $articleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="backend_article_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('backend_article_index');
        }

        return $this->render('backend/codex/article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_article_show", methods="GET")
     */
    public function show(Article $article): Response
    {
        return $this->render('backend/codex/article/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/{id}/edit", name="backend_article_edit", methods="GET|POST")
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_article_edit', ['id' => $article->getId()]);
        }

        return $this->render('backend/codex/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
