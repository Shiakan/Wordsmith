<?php

namespace App\Controller\Backend\Forum;

use App\Entity\CharacterProfile;
use App\Form\CharacterProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backend/characterprofile")
 */
class CharacterProfileController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="backend_characterprofile_edit", methods="GET|POST")
     */
    public function edit(Request $request, CharacterProfile $characterProfile): Response
    {
        $form = $this->createForm(CharacterProfileType::class, $characterProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('backend_user_index');
        }

        return $this->render('backend/forum/character_profile/edit.html.twig', [
            'characterProfile' => $characterProfile,
            'form' => $form->createView(),
        ]);
    }
}
