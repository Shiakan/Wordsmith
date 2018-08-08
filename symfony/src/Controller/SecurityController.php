<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;

use App\Entity\Charactersheet;
use App\Form\RegistrationType;
use App\Entity\CharacterProfile;
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

        // On récupère le rôle 'utilisateur'
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $role = $repository->findAll();
        $roleUser = $role[2];

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setRoles($roleUser);
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            // On redirige vers le login
            // return $this->redirectToRoute('security_login');
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
        // On récupère les erreurs s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();
        // On récupère le dernier username entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout() 
    {
        // On laisse la fonction vide
    }
}
