<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/user")
 */
class UserBackendController extends Controller
{
    /**
     * @Route("/", name="backend_user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('backend/user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/{id}", name="backend_user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('backend/user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="backend_user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('backend/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('backend_user_index');
    }
}
