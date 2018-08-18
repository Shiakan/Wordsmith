<?php

namespace App\Controller\Backend\Forum;

use App\Entity\Subcategory;
use App\Form\SubcategoryType;
use App\Repository\SubcategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/forum/subcategory")
 */
class SubcategoryController extends Controller
{
    /**
     * @Route("/", name="subcategory_index", methods="GET")
     */
    public function index(): Response
    {
         $repository = $this->getDoctrine()->getRepository(Subcategory::class);
         $subcategories = $repository->findAll();

        return $this->render('backend/forum/subcategory/index.html.twig', [
            'subcategories' => $subcategories,
            ]);
    }

    /**
     * @Route("/new", name="subcategory_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subcategory);
            $em->flush();

            return $this->redirectToRoute('subcategory_index');
        }

        return $this->render('backend/forum/subcategory/new.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subcategory_show", methods="GET")
     */
    public function show(Subcategory $subcategory): Response
    {
        return $this->render('backend/forum/subcategory/show.html.twig', ['subcategory' => $subcategory]);
    }

    /**
     * @Route("/{id}/edit", name="subcategory_edit", methods="GET|POST")
     */
    public function edit(Request $request, Subcategory $subcategory): Response
    {
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subcategory_edit', ['id' => $subcategory->getId()]);
        }

        return $this->render('backend/forum/subcategory/edit.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subcategory_delete", methods="DELETE")
     */
    public function delete(Request $request, Subcategory $subcategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subcategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subcategory);
            $em->flush();
        }

        return $this->redirectToRoute('subcategory_index');
    }
}
