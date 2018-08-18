<?php

namespace App\Controller;

use App\Enity\Room;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/profil/{id}", name="user_profile")
     */
    public function show(User $user, RoomRepository $roomRepository) : Response
    {
        $currentUser = $user;
        
        return $this->render('user/show.html.twig', [
            'user' => $currentUser,
            'rooms' => $roomRepository->findAll()
        ]);
    }

     /**
     * @Route("/profil/{id}/edit", name="user_profile_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        //Dans le cas où l'utilisateur veut modifier son profil mais pas son mot de passe,
        // on récupère son ancien mot de passe
        $oldPassword = $user->getPassword();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Si l'utilisateur n'a pas changé son mot de passe, alors on récupère du nul
            // on passe donc l'ancien mot de passe à encodedPassword
            if(is_null($user->getPassword())){
                $encodedPassword = $oldPassword;
            } else {
                $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
            }
            // Si l'utilisateur a changé son mot de passe, alors il faut l'encoder avant de le sauvegarder en database
            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();
            
            // On renvoie l'utilisateur à sa page de profil
            return $this->redirectToRoute('user_profile', ['id' => $user->getId()]);
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
