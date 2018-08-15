<?php

namespace App\Controller;

use App\Entity\CharacterProfile;
use App\Form\CharacterProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharacterProfileController extends AbstractController
{
    /**
     * @Route("/characterprofile/{id}/edit", name="characterprofile_edit", methods="GET|POST")
     */
    public function edit(Request $request, CharacterProfile $characterProfile): Response
    {
        $form = $this->createForm(CharacterProfileType::class, $characterProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('user_profile', ['id' => $characterProfile->getUser()->getId()]);
        }

        return $this->render('character_profile/edit.html.twig', [
            'characterProfile' => $characterProfile,
            'form' => $form->createView(),
        ]);
    }
}
