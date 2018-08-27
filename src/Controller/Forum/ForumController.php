<?php

namespace App\Controller\Forum;
use App\Entity\Post;
use App\Entity\Thread;
use App\Entity\Category;
use App\Form\SubjectType;
use App\Entity\Subcategory;
use App\Entity\HasReadThread;
use App\Entity\HasReadSubcategory;
use App\Repository\ThreadRepository;
use App\Repository\SubcategoryRepository;
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

        return $this->render('forum/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/forum/{subcategory_slug}/page/{page}", name="forum_subcategory", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET|POST")
     */
    public function showSubcategory($subcategory_slug, SubcategoryRepository $subcategoryRepository, ThreadRepository $threadRepository , Request $request, $page, UserInterface $user=null)
    {
        $limit = 10; //limite de questions par page (pagination)

        $subcategory = $subcategoryRepository->findOneBySlug($subcategory_slug);
        $threads = $threadRepository->findByAll($page,$limit,$subcategory,$user); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalThreads = $threadRepository->findCountMax($subcategory); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalThreads / $limit); // nombre de page max à afficher (sert pour bouton suivant)
        // dump($subcategory_slug);die;
        return $this->render('forum/subcategory_show.html.twig', [
            'subcategory'=> $subcategory,
            'page'=>$page,
            'pageMax'=>$pageMax,
            'threads' => $threads
        ]);
    }
}