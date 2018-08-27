<?php

namespace App\Controller\Forum;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Service\Slugger;
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
use PhpParser\Node\Expr\PostDec;

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
    public function new(Request $request, UserInterface $user=null, $subcategory_id, Slugger $slugger): Response
    {   
        $thread = new Thread();
        
        // On récupère la sous-catégorie dans laquelle l'utilisateur poste son sujet
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $currentSubcategory = $repository->findOneById($subcategory_id);

        $form = $this->createForm(ThreadType::class);
        $form->handleRequest($request);

        //On vérifie si le formulaire est valide et contient bien les informations nécessaires
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('thread');

            //On récupère les données liées à l'entité Thread
            $title = $data['title'];
            $subtitle = $data['subtitle'];
            //On récupère les données liées à l'entité Post
            $content = $data['content'];

            //On entre les données passées par l'utilisateur en base de données
            $em = $this->getDoctrine()->getManager();
            $thread->setAuthor($user);
            $thread->setTitle($title);
            $thread->setSubcategory($currentSubcategory);
            $thread->setSubtitle($subtitle);
            $thread->setSlug(
                $slugger->slugify($thread->getTitle()));
            $em->persist($thread);
            $em->flush();

            //A chaque fois qu'un utilisateur poste un nouveau thread, il poste également un nouveau post
            $this->createPost($thread, $content, $user);
            // A chaque fois qu'un utilisateur poste un nouveau thread, on va l'ajouter à la table has_read_thread x le nombre d'utilisateurs
            $this->createHasRead($thread);

            return $this->redirectToRoute('thread_show', [
                'thread_slug' => $thread->getSlug()
            ]);
        }
        return $this->render('forum/thread/new.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
            'subcategory' => $currentSubcategory
        ]);
    }
    public function createHasRead($thread) {
        //On récupère la liste de tous les utilisateurs présents sur le site
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        //Pour chaque utilisateur présent sur le site, on ajoute le nouveau thread créé dans la table has_read_thread
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
        //Lorsqu'un utilisateur créé un nouveau thread, il créé automatiquement un nouveau post
        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $post->setThread($thread);
        $post->setSubcategory($thread->getSubcategory());
        $post->setContent($content);
        $post->setAuthor($user);
        $em->persist($post);
        $em->flush();

        //On ajoute ce nouveau post au champ "last_post" de l'entité Thread afin de pouvoir l'afficher dans la liste des sujets d'une sous-catégorie
        $thread = $post->getThread();
        $thread->setLastPost($post);
        $em->flush();

        //On ajoute ce nouveau post au champ "last_post" de l'entité Subcategory afin de pouvoir l'afficher sur la homepage du forum
        $subcategory = $post->getSubcategory();
        $subcategory->setLastPost($post);
        $em->flush();
        
    }

    /**
     * @Route("/topic/{thread_slug}/page/{page}", name="thread_show", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET|POST")
     */
    public function show($thread_slug, ThreadRepository $threadRepository, Request $request, UserInterface $user=null, $page): Response
    {    
        $thread = $threadRepository->findOneBySlug($thread_slug);
        $limit = 10; //limite de questions par page (pagination)
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postRepository->findByAll($page,$limit, $thread); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalPosts =  $postRepository->findCountMax($thread); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalPosts / $limit); // nombre de page max à afficher (sert pour bouton suivant)
        
        //On créé le formulaire pour changer un sujet de sous-catégorie
        $form = $this->createForm(SubjectType::class, $thread);

        //Lorsqu'un utilisateur visite un thread, on update les tables has_read_thread & has_read_subcategory, puisqu'une visite = une lecture
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
        
        // On vérifie si l'utilisateur a déjà lu le thread ou pas, donc on cherche si l'association user + thread existe dans l'entité has_read_thread
        $repositoryThread = $this->getDoctrine()->getRepository(HasReadThread::class);
        $readThread = $repositoryThread->findTimeStamp($user, $thread);
        
        //Si elle n'existe pas, on la créé
        if($readThread == false) {
            $em = $this->getDoctrine()->getManager();
            $hasReadThread->setThread($thread);
            $hasReadThread->setUser($user);
            $hasReadThread->setPostCount($postCount);
            $em->persist($hasReadThread);
            $em->flush();
        } else{
            //Si elle existe, on doit vérifier si elle est à jour
            $currentCount = $readThread->getpostCount();
            // Si le nombre de posts dans l'entité has_read_thread est inférieure au nombre de posts que possède ce thread, alors l'utilisateur
            //ne l'avait pas encore lu, on fait donc une mise à jour
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
        // On récupère les données de l'ancienne sous-catégorie du thread
        $previousSubcategory = $thread->getSubcategory();
        
        //On récupère les données de la nouvelle sous-catégorie dans laquelle on veut déplacer le thread
        $data = $request->request->get('subject');
        $subcategoryId = $data['subcategory'];

        //On récupère la sous-catégorie dans laquelle on veut déplacer le thread
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $newSubcategory = $repository->findOneById($subcategoryId);

        //On récupère l'ancienne sous-catégorie du thread
        $formerSubcategory = $repository->findOneById($previousSubcategory);

        // On passe la nouvelle sous-catégorie au thread que l'on déplace
        $em = $this->getDoctrine()->getManager();
        $thread->setSubcategory($newSubcategory);
        $em->flush();

        //Pour chaque post de ce thread, on lui passe également la nouvelle sous-catégorie
        $posts = $thread->getPosts();
        foreach($posts as $post){
            $post->setSubcategory($newSubcategory);
        }
        $em->flush();

        // On récupère le nombre de threads présents dans l'ancienne sous-catégorie
        $nbThreads = count($formerSubcategory->getThreads());

        //Si l'ancienne sous-catégorie n'a pas d'autres threads, on lui dit que la colonne "last_post" = null
        if($nbThreads == 0){
            $formerSubcategory->setLastPost(null);
            $em->flush();
         }else {
             //Si l'ancienne sous-catégorie a d'autres threads, on va récupérer le post le plus récent parmi ces autres threads,
             //et on passe à la colonne "last_post" ce post qui est le nouveau post le plus récent
            $repositoryPost = $this->getDoctrine()->getRepository(Post::class);
            $newerPost = $repositoryPost->findLastPost($formerSubcategory);
            $formerSubcategory->setLastPost($newerPost);
            $em->flush();
        }

        //On passe le dernier post du thread que l'on vient de déplacer dans la sous-catégorie dans laquelle on vient de le déplacer
        $newSubcategory->setLastPost($thread->getLastPost());
        $em->flush();

        //On redirige vers la sous-catégorie dans laquelle on vient de déplacer le thread
        return $this->redirectToRoute('forum_subcategory', ['subcategory_slug' => $newSubcategory->getSlug()]);
    }

    /**
     * @Route("/{slug}/edit", name="thread_edit", methods="GET|POST")
     */
    public function edit(Request $request, Thread $thread, Slugger $slugger): Response
    {
        $editForm = $this->createForm(EditThreadType::class, $thread);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $thread->setSlug(
                $slugger->slugify($thread->getTitle()));
            $em->flush();
            
            return $this->redirectToRoute('thread_show', ['thread_slug' => $thread->getSlug()]);
        }
        return $this->render('forum/thread/edit.html.twig', [
            'thread' => $thread,
            'editForm' => $editForm->createView(),
        ]);
    }
}