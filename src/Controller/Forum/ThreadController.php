<?php

namespace App\Controller\Forum;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Form\SubjectType;
use App\Entity\Subcategory;
use App\Form\EditThreadType;
use App\Entity\HasReadThread;
use App\Entity\HasReadSubcategory;
use App\Repository\PostRepository;
use App\Repository\ThreadRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/forum")
 */
class ThreadController extends Controller
{
    /**
     * @Route("/", name="thread_index", methods="GET")
     */
    public function index(ThreadRepository $threadRepository): Response
    {
        return $this->render('forum/thread/index.html.twig', ['threads' => $threadRepository->findAll()]);
    }
    /**
     * @Route("/thread/{subcategory_id}/new", name="thread_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user=null, $subcategory_id): Response
    {   
        $thread = new Thread();
        
        // On récupère la sous-catégorie dans laquelle l'utilisateur poste son sujet
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $currentSubcategory = $repository->findOneById($subcategory_id);

        $form = $this->createForm(ThreadType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('thread');
            $title = $data['title'];
            $subtitle = $data['subtitle'];
            $content = $data['content'];
            $em = $this->getDoctrine()->getManager();
            $thread->setAuthor($user);
            $thread->setTitle($title);
            $thread->setSubcategory($currentSubcategory);
            $thread->setSubtitle($subtitle);
            $em->persist($thread);
            $em->flush();
            $this->createPost($thread, $content, $user);
            $this->createHasRead($thread);
            return $this->redirectToRoute('thread_show', [
                'id' => $thread->getId()
            ]);
        }
        return $this->render('forum/thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
            'subcategory' => $currentSubcategory
        ]);
    }
    public function createHasRead($thread) {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        foreach($users as $user) {
            $hasReadThread = new HasReadThread();
            $em = $this->getDoctrine()->getManager();
            $hasReadThread->setThread($thread);
            $hasReadThread->setUser($user);
            $hasReadThread->setPostCount(0);
            $em->persist($hasReadThread);
        }
        
        $em->flush(); //Persist objects that did not make up an entire batch
        $em->clear();
    }
    public function createPost($thread, $content, $user)
    {
        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $post->setThread($thread);
        $post->setSubcategory($thread->getSubcategory());
        $post->setContent($content);
        $post->setAuthor($user);
        $em->persist($post);
        $em->flush();

        $thread = $post->getThread();
        $thread->setLastPost($post);
        $em->flush();

        $subcategory = $post->getSubcategory();
        $subcategory->setLastPost($post);
        $em->flush();
        
    }
    /**
     * @Route("/thread/{id}/page/{page}", name="thread_show", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET|POST")
     */
    public function show(Thread $thread, Request $request, UserInterface $user=null, $page): Response
    {   
        $limit = 10; //limite de questions par page (pagination)
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postRepository->findByAll($page,$limit, $thread); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalPosts =  $postRepository->findCountMax($thread); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalPosts / $limit); // nombre de page max à afficher (sert pour bouton suivant)
        
        $form = $this->createForm(SubjectType::class, $thread);
        $this->hasReadThread($thread, $user);
        $this->hasReadSubcategory($thread->getSubcategory(), $user);
        
        return $this->render('forum/thread/show.html.twig', [
            'thread' => $thread,
            'page'=>$page,
            'pageMax'=>$pageMax,
            'posts'=>$posts,
            'form' => $form->createView() ]);
    }
    public function hasReadThread($thread, $user)
    {
        $hasReadThread = new HasReadThread();
        $postCount = count($thread->getPosts());
        
        // We need to check if the user visiting the page has already read 
        // this thread
        $repositoryThread = $this->getDoctrine()->getRepository(HasReadThread::class);
        $readThread = $repositoryThread->findTimeStamp($user, $thread);
        if($readThread == false) {
            $em = $this->getDoctrine()->getManager();
            $hasReadThread->setThread($thread);
            $hasReadThread->setUser($user);
            $hasReadThread->setPostCount($postCount);
            $hasReadThread->setTimestamp(new \DateTime());
            $em->persist($hasReadThread);
            $em->flush();
        } else{
            $currentCount = $readThread->getpostCount();
            if($currentCount == null || $currentCount < $postCount) {
                $em = $this->getDoctrine()->getManager();
                $readThread->setPostCount($postCount);
                $em->persist($readThread);
                $em->flush();
            }
        }
    }

    public function hasReadSubcategory($subcategory, $user)
    {
        $hasReadSubcategory = new HasReadSubcategory();

        //On récupère le nombre de sujets et de posts postés dans la sous-catégorie
        $threadCount = count($subcategory->getThreads());
        $postCount = count($subcategory->getPosts());
        
        // On vérifie si l'utilisateur a déjà visité cette sous-catégorie
        $repositorySubcategory = $this->getDoctrine()->getRepository(HasReadSubcategory::class);
        $readSubcategory = $repositorySubcategory->findHasRead($user, $subcategory);

        //Si l'utilisateur n'a jamais visité la sous-catégorie
        if($readSubcategory == false) {
            $em = $this->getDoctrine()->getManager();
            $hasReadSubcategory->setSubcategory($subcategory);
            $hasReadSubcategory->setUser($user);
            $hasReadSubcategory->setThreadCount($threadCount);
            $hasReadSubcategory->setPostCount($postCount);
            $em->persist($hasReadSubcategory);
            $em->flush();
        } else{
            // Si l'utilisateur a déjà visité la sous-catégorie, on doit vérifier si le nombre de threads
            //et de posts est le même que la dernière fois qu'il l'a visitée
            $currentThreadCount = $readSubcategory->getThreadCount();
            $currentPostCount = $readSubcategory->getPostCount();
            //Si c'est nul ou inférieur, alors en cliquant sur la sous-catégorie, l'utilisateur la "lit" 
            // et on update le nombre de posts & de threads
            if($currentThreadCount == null || $currentThreadCount < $threadCount || $currentPostCount == null || $currentPostCount < $postCount) {
                $em = $this->getDoctrine()->getManager();
                $readSubcategory->setThreadCount($threadCount);
                $readSubcategory->setPostCount($postCount);
                $em->persist($readSubcategory);
                $em->flush();
            }
        }
    }

    /**
     * @Route("/thread/{id}/move", name="thread_move", methods="POST")
     */
    public function moveThread(Request $request, Thread $thread): Response 
    {
        
        $data = $request->request->get('subject');
        $subcategoryId = $data['subcategory'];
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $subcategory = $repository ->findById($subcategoryId);
        $newSubcategory = $subcategory[0];
        $em = $this->getDoctrine()->getManager();
        $thread->setSubcategory($newSubcategory);
        $em->persist($thread);
        $em->flush();
        return $this->redirectToRoute('forum_subcategory', ['name' => $newSubcategory->getName()]);
    }
    /**
     * @Route("/thread/{id}/edit", name="thread_edit", methods="GET|POST")
     */
    public function edit(Request $request, Thread $thread): Response
    {
        $editForm = $this->createForm(EditThreadType::class, $thread);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('thread_show', ['id' => $thread->getId()]);
        }
        return $this->render('forum/thread/edit.html.twig', [
            'thread' => $thread,
            'editForm' => $editForm->createView(),
        ]);
    }
}