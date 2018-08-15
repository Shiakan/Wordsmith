<?php

namespace App\Controller\Forum;

use App\Entity\Category;
use App\Entity\Subcategory;
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
     * @Route("/forum/{name}", name="forum_subcategory")
     */
    public function showSubcategory(Subcategory $subcategory)
    {
        return $this->render('forum/show.html.twig', [
            'subcategory'=> $subcategory,
        ]);
    }
}