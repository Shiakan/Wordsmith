<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;

use App\Form\LoginType;
use App\Entity\Charactersheet;
use App\Form\RegistrationType;
use App\Entity\CharacterProfile;
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
        // On récupère le rôle 'utilisateur'
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $role = $repository->findAll();
        $roleUser = $role[2];

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){ //Si le form est valide et envoyé alors
            $hash = $encoder->encodePassword($user, $user->getPassword());  //On encode le mot de passe
            $user->setRole($roleUser); //On set le role de l'utilisateur
            $user->setPassword($hash); // On set le passeword avec le hash
            $manager->persist($user); //On persist user
            $manager->flush(); //On flush le tout
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
                    // On redirige vers le login
                    return $this->redirectToRoute('security_login');
        }
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

      /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {   

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'Vous êtes déjà connecté');
            return $this->redirectToRoute('homepage');
        } else {
            $authenticationUtils = $this->get('security.authentication_utils');
            $defaultData = array('username' => $authenticationUtils->getLastUsername());

            $form = $this->createForm(LoginType::class, $defaultData);

            if (!is_null($authenticationUtils->getLastAuthenticationError(false))) {
                $form->addError(new FormError(
                    $authenticationUtils->getLastAuthenticationError()->getMessageKey()
                ));
            }
            $form->handleRequest($request);
            return $this->render('security/login.html.twig',[
                'form' => $form->createView(),
            ]
                    
            );
        }
    }

    public function createSheets($user)
    {
        $characterProfile = new CharacterProfile();
        $charactersheet = new Charactersheet();

        $em = $this->getDoctrine()->getManager();
        $characterProfile->setUser($user);
        $characterProfile->setAvatar('rdgregz');
        $em->persist($characterProfile);
        $em->flush();

        $charactersheet->setUser($user);
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
