<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/profil/{id}", name="user_profile")
     */
    public function show(User $user) : Response
    {
        $currentUser = $user;
        
        return $this->render('user/show.html.twig', [
            'user' => $currentUser
        ]);
    }
}
