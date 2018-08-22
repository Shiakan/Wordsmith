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
     * @Route("/forum/subcategory/{id}/page/{page}", name="forum_subcategory", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET|POST")
     */
    public function showSubcategory(Subcategory $subcategory,ThreadRepository $threadRepository , Request $request, $page, UserInterface $user=null)
    {
        $limit = 10; //limite de questions par page (pagination)
        $threads = $threadRepository->findByAll($page,$limit,$subcategory,$user); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalThreads = $threadRepository->findCountMax($subcategory); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalThreads / $limit); // nombre de page max à afficher (sert pour bouton suivant)

        // $this->hasRead($subcategory, $user);
        
        return $this->render('forum/show.html.twig', [
            'subcategory'=> $subcategory,
            'page'=>$page,
            'pageMax'=>$pageMax,
            'threads' => $threads,
        ]);
    }

    // public function hasRead($subcategory, $user)
    // {
    //     $hasReadSubcategory = new HasReadSubcategory();

    //     //On récupère le nombre de sujets et de posts postés dans la sous-catégorie
    //     $threadCount = count($subcategory->getThreads());
    //     $postCount = count($subcategory->getPosts());
        
    //     // On vérifie si l'utilisateur a déjà visité cette sous-catégorie
    //     $repositorySubcategory = $this->getDoctrine()->getRepository(HasReadSubcategory::class);
    //     $readSubcategory = $repositorySubcategory->findHasRead($user, $subcategory);

    //     //Si l'utilisateur n'a jamais visité la sous-catégorie
    //     if($readSubcategory == false) {
    //         $em = $this->getDoctrine()->getManager();
    //         $hasReadSubcategory->setSubcategory($subcategory);
    //         $hasReadSubcategory->setUser($user);
    //         $hasReadSubcategory->setThreadCount($threadCount);
    //         $hasReadSubcategory->setPostCount($postCount);
    //         $em->persist($hasReadSubcategory);
    //         $em->flush();
    //     } else{
    //         // Si l'utilisateur a déjà visité la sous-catégorie, on doit vérifier si le nombre de threads
    //         //et de posts est le même que la dernière fois qu'il l'a visitée
    //         $currentThreadCount = $readSubcategory->getThreadCount();
    //         $currentPostCount = $readSubcategory->getPostCount();
    //         //Si c'est nul ou inférieur, alors en cliquant sur la sous-catégorie, l'utilisateur la "lit" 
    //         // et on update le nombre de posts & de threads
    //         if($currentThreadCount == null || $currentThreadCount < $threadCount || $currentPostCount == null || $currentPostCount < $postCount) {
    //             $em = $this->getDoctrine()->getManager();
    //             $readSubcategory->setThreadCount($threadCount);
    //             $readSubcategory->setPostCount($postCount);
    //             $em->persist($readSubcategory);
    //             $em->flush();
    //         }
    //     }
    // }
}