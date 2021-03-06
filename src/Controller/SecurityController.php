<?php

namespace App\Controller;

use App\Entity\Rank;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Group;
use App\Entity\Thread;
use App\Form\LoginType;
use App\Entity\Subcategory;
use App\Entity\HasReadThread;
use App\Entity\Charactersheet;
use App\Form\RegistrationType;
use App\Entity\CharacterProfile;
use App\Entity\HasReadSubcategory;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {   
        $user = new User();
        // On récupère le rôle 'membre' pour le donner automatiquement à chaque nouvel inscrit
        $code = 'ROLE_USER';
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $roleUser = $repository->findOneByCode($code);

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ //Si le form est valide et envoyé alors
            $hash = $encoder->encodePassword($user, $user->getPassword());  //On encode le mot de passe
            $user->setRole($roleUser); //On set le role de l'utilisateur
            $user->setPassword($hash); // On set le passeword avec le hash
            $manager->persist($user); //On persist user
            $manager->flush(); //On flush le tout

            //On crée automatiquement un profil forum & une charactersheet à l'utilisateur lorsqu'il s'inscrit
            $this->createSheets($user);
            

            $message= (new \Swift_Message('Hello Mail')) //On instancie Swift Mailer
                    ->setSubject('Bienvenue '.$user->getUsername().'') //On définie le sujet du mail
                    ->setFrom('projetkelnor@gmail.com') //On définie l'expéditeur
                    ->setTo($user->getEmail()) //Grâce à l'enregistrement, on définie le destinataire
                    ->setContentType("text/html") //On définie que le contenue est un mail html
                    ->setBody(  //On définie le body comme étant
                        $this->renderView('emails/registration.html.twig', //Ce fichier twig
                            ['user'=>$user] //On lui passe user
                        )
                    );
            //On envoie le mail
            $mailer->send($message);
            
            $this->createHasReadThread($user);
            $this->createHasReadSubcategory($user);
            // On redirige vers le login
            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function createHasReadSubcategory($user) {
        
        $repository = $this->getDoctrine()->getRepository(Subcategory::class);
        $subcategories = $repository->findAll();

        foreach($subcategories as $subcategory) {
            $hasReadSubcategory = new HasReadSubcategory();
            $manager = $this->getDoctrine()->getManager();
            $hasReadSubcategory->setSubcategory($subcategory);
            $hasReadSubcategory->setUser($user);
            $hasReadSubcategory->setThreadCount(count($subcategory->getThreads()));
            $hasReadSubcategory->setPostCount(count($subcategory->getPosts()));
            $manager->persist($hasReadSubcategory);
        }
        
        $manager->flush(); //Persist objects that did not make up an entire batch
    }

    public function createHasReadThread($user) {
        
        $repository = $this->getDoctrine()->getRepository(Thread::class);
        $threads = $repository->findAll();

        foreach($threads as $thread) {
            $hasReadThread = new HasReadThread();
            $em = $this->getDoctrine()->getManager();
            $hasReadThread->setThread($thread);
            $hasReadThread->setUser($user);
            $hasReadThread->setPostCount(count($thread->getPosts()));
            $em->persist($hasReadThread);
        }
        
        $em->flush(); //Persist objects that did not make up an entire batch
        // $em->clear();
    }
      /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {   
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'Vous êtes déjà connecté');
            return $this->redirectToRoute('homepage');
        } 
        else {
            $authenticationUtils = $this->get('security.authentication_utils');
            $defaultData = array('username' => $authenticationUtils->getLastUsername());
            $form = $this->createForm(LoginType::class, $defaultData);

            $error = $authenticationUtils->getLastAuthenticationError();
            $form->handleRequest($request);
            return $this->render('security/login.html.twig',[
                'form' => $form->createView(),
                'error' => $error
                ]    
            );
        }
    }
    public function createSheets($user)
    {   
        $characterProfile = new CharacterProfile();
        $charactersheet = new Charactersheet();

        $repositoryRank = $this->getDoctrine()->getRepository(Rank::class);
        $rank = $repositoryRank->findOneByName('Membre');

        $repositoryGroup = $this->getDoctrine()->getRepository(Group::class);
        $group = $repositoryGroup->findOneByName('Membre');

        $em = $this->getDoctrine()->getManager();
        $characterProfile->setUser($user);
        // On donne un avatar, un groupe et un rang par défaut à chaque nouvel utilisateur
        $characterProfile->setAvatar('https://nsa39.casimages.com/img/2018/08/22/mini_180822112250709313.png');
        $characterProfile->setRank($rank);
        $characterProfile->setGroupForum($group);
        $em->persist($characterProfile);
        $em->flush();
        $charactersheet->setUser($user);
        $charactersheet->setContent(
            'INFORMATIONS PERSONNELLES'."\n".'Prénom et nom : '."\n".'Age : '."\n".'Race : '."\n".'Sexe : '."\n".'Classe : '."\n".'Classe sociale : '."\n".
            '_________________________'."\n".
            'STATISTIQUES'."\n".'Apparence : '."\n".'Constitution : '."\n".'Dextérité : '."\n".'Force : '."\n".'Education : '."\n".'Intelligence : '."\n".'Sagesse'."\n".
            '_________________________'."\n".
            'POINTS DE VIE : '."\n".'POINTS D\'ETHER : '."\n".'CORRUPTION : '."\n".
            '_________________________'."\n".
            'COMPÉTENCES DE BASE'."\n".'Charisme : '."\n".'Vitalité : '."\n".'Agilité : '."\n".'Puissance : '."\n".'Connaissances : '."\n".'Intuition : '."\n".'Volonté : '."\n".
            '_________________________'."\n".
            'COMPÉTENCES DE CLASSE ET BONUS'."\n".
            '_________________________'."\n".
            'INVENTAIRE (équipement, armes, etc...)'."\n".'- '."\n".'- '."\n".
            '_________________________'."\n".
            'LIVRE DE SORTS'."\n".'- '."\n".'- '."\n".
            '_________________________'."\n".
            'ANECDOTES'."\n"
        );
        $em->persist($charactersheet);
        $em->flush();

    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout() 
    {
        // On laisse la fonction vide
    }
}