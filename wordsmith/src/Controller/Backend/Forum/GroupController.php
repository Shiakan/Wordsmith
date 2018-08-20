<?php

namespace App\Controller\Backend\Forum;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/group")
 */
class GroupController extends Controller
{
    /**
     * @Route("/", name="backend_group_index", methods="GET|POST")
     */
    public function index(Request $request): Response
    {
         //On récupère les groupes
        $repository = $this->getDoctrine()->getRepository(Group::class);
        $groups = $repository->findAll();
        //On crée le form mappé sur Group
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
          // On vérifie que le form a été submit et est valide
        if ($form->isSubmitted() && $form->isValid()) {
              //On insère en database
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
         // On redirige vers la page de la liste des tags
            return $this->redirectToRoute('backend_group_index');
        }

        return $this->render('backend/forum/group/index.html.twig', [
            'groups' => $groups,
            'group'  => $group,
            'form'  => $form->createView(),
            ]);
    }

    /**
     * @Route("/{id}/edit", name="backend_group_edit", methods="GET|POST")
     */
    public function edit(Request $request, Group $group): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_group_index', ['id' => $group->getId()]);
        }

        return $this->render('backend/forum/group/edit.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_group_delete", methods="DELETE")
     */
    public function delete(Request $request, Group $group): Response
    {
        if ($this->isCsrfTokenValid('delete'.$group->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
        }

        return $this->redirectToRoute('backend_group_index');
    }
}
