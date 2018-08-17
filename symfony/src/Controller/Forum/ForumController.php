<?php

namespace App\Controller\Forum;

use App\Entity\Thread;
use App\Entity\Category;
use App\Form\SubjectType;
use App\Entity\Subcategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum_index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repository ->findAll();

        return $this->render('forum/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/forum/{name}", name="forum_subcategory", methods="GET|POST")
     */
    public function showSubcategory(Subcategory $subcategory, Thread $thread, Request $request)
    {
                $form = $this->createForm(SubjectType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_index');
        }

        return $this->render('forum/show.html.twig', [
            'subcategory'=> $subcategory,
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }
}
