<?php

namespace App\Controller\Backend\Codex;

use App\Entity\Comment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Route("/backend/codex/comment")
 */

class CommentController extends Controller
{
    /**
     * @Route("/hide/{id}", name="hide_comment")
     */
    public function hide(Comment $comment)
    {   
        $em = $this->getDoctrine()->getManager();
        // Si la réponse avait le statut false (donc 'non valide') alors on le passe à true = valide
        if($comment->getStatus() === false) {
            $comment->setStatus(true);
            $em->flush();
        }
        else {
            // Si la réponse avait le statut true (donc 'valide') on le passe à false = non valide
            $comment->setStatus(false);
            $em->flush();
        }
        // On redirige vers la page de la question concernée
        return $this->redirectToRoute('article_show', ['slug' => $comment->getArticle()->getSlug()]);
    }
}