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
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {   
        $user = new User();

        // On récupère le rôle 'membre' pour le donner automatiquement à chaque nouvel inscrit
        $code = 'ROLE_USER';
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $roleUser = $repository->findOneByCode($code);

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setRole($roleUser);
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            //On crée automatiquement un profil forum & une charactersheet à l'utilisateur lorsqu'il s'inscrit
            $this->createSheets($user);

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
                $this->addFlash('warning', 'nope');
                // $form->addError(new FormError(
                //     $authenticationUtils->getLastAuthenticationError()->getMessageKey()
                // ));
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
        // On donne un avatar, un groupe et un rang par défaut à chaque nouvel utilisateur
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
