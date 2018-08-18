<?php

namespace App\Controller\Forum;

use App\Entity\Thread;
use App\Entity\Category;
use App\Form\SubjectType;
use App\Entity\Subcategory;
use App\Entity\HasReadThread;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum_index")
     */
    public function index(UserInterface $user = null)
    {
        $repositoryCategory = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repositoryCategory ->findAll();

        $repositoryHasRead = $this->getDoctrine()->getRepository(HasReadThread::class);
        $hasReadThreads = $repositoryHasRead->findByUser($user);


        return $this->render('forum/index.html.twig', [
            'categories' => $categories,
            'hasReadThreads' => $hasReadThreads
        ]);
    }

    /**
     * @Route("/forum/{name}", name="forum_subcategory", methods="GET|POST")
     */
    public function showSubcategory(Subcategory $subcategory, Request $request)
    {
        $threads = $subcategory->getThreads();

        return $this->render('forum/show.html.twig', [
            'subcategory'=> $subcategory,
            'thread' => $threads
        ]);
    }
}
