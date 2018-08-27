<?php

namespace App\Controller\Backend\Forum;

use App\Entity\Post;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Route("/backend/forum/post")
 */

class PostController extends Controller
{
    /**
     * @Route("/hide/{id}", name="hide_post")
     */
    public function hide(Post $post)
    {   
        $em = $this->getDoctrine()->getManager();
        // Si la réponse avait le statut false (donc 'non valide') alors on le passe à true = valide
        if($post->getStatus() === false) {
            $post->setStatus(true);
            $em->flush();
        }
        else {
            // Si la réponse avait le statut true (donc 'valide') on le passe à false = non valide
            $post->setStatus(false);
            $em->flush();
        }
        // On redirige vers la page de la question concernée
        return $this->redirectToRoute('thread_show', ['thread_slug' => $post->getThread()->getSlug()]);
    }
}