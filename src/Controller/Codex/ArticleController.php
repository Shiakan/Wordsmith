<?php

namespace App\Controller\Codex;


use App\Entity\Tag;
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

/**
 * @Route("/codex")
 */

class ArticleController extends Controller
{
    /**
     * @Route("/article/show/{id}", name="article_show")
     */
    public function show(Article $article, Request $request, ObjectManager $manager, UserInterface $user=null)
    {   
        //On récupère les tags de l'article
        $repositoryTag= $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repositoryTag->findByOrderId();

        //On créé le formulaire pour poster un nouveau commentaire
        $comment = new Comment();
        $form = $this->createForm(CommentType::class , $comment);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($user); //On passe l'auteur du commentaire
            $comment->setArticle($article); //On passe l'article pour y rattacher le commentaire
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('article_show',['id'=>$article->getId()]);
        }
        return $this->render('codex/article/show.html.twig', [
            'article'=> $article,
            'tags' => $tags,
            'form' => $form->createView(),
        ]); 
    }

    /**
     * @Route("/show/tag/{id}", name="search_by_tags")
     */
    public function findArticlesByTag(Tag $tag)
    {
        $repositoryTag= $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repositoryTag->findAll();

        $articles = $tag->getArticles();
        return $this->render('codex/article/taglist.html.twig', [
            'articles' =>$articles, 
            'tag'=>$tag,
            'tags' => $tags
        ]);
    }
    
}
