<?php

namespace App\Controller\Backend\Codex;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\SearchingType;
use App\Service\Slugger;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/backend/codex/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/page/{page}", name="backend_article_index", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET")
     */
    public function index(ArticleRepository $articleRepository, $page): Response
    {
        $limit = 5; //limite de questions par page (pagination)
        $articles = $articleRepository->findByAll($page,$limit); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalArticles =  $articleRepository->findCountMax(); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalArticles / $limit); // nombre de page max à afficher (sert pour bouton suivant)
        $form = $this->createForm(SearchingType::class);
        return $this->render('backend/codex/article/index.html.twig', [
            'articles' => $articles,
            'page'=>$page,
            'pageMax'=>$pageMax,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="backend_article_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user, Slugger $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setAuthor($user);
            $article->setSlug(
                $slugger->slugify($article->getTitle()));
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
    public function edit(Request $request, Article $article, Slugger $slugger): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setSlug(
                $slugger->slugify($article->getTitle()));
            $em->flush();

            return $this->redirectToRoute('backend_article_index');
        }

        return $this->render('backend/codex/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/hide", name="backend_article_hide")
     */
    public function hide(Article $article)
    {   
        $em = $this->getDoctrine()->getManager();

        if($article->getStatus() === true) {
            // On passe le statut à false pour que la réponse ne soit plus affichée
            $article->setStatus(false);
            $em->flush();
        } else {
            // On passe le statut à ftrue pour que la réponse soit affichée
            $article->setStatus(true);
            $em->flush();
        }
        //On redirige ensuite sur la page de la question où l'on se trouvait
        return $this->redirectToRoute('backend_article_index');
    }
    /**
     * @Route("/search", name="back_search_article")
     */
    public function findBakArticleBySearch(Request $request)
    {
        $data = $request->request->get('searching');
        $title = $data['title'];

        $repositoryArticle = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repositoryArticle->findBySearch($title);

        return $this->render('backend/codex/article/search.html.twig', [
            'articles' =>$articles,
        ]);
    }
}
