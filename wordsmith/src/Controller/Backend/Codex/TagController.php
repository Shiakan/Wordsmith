<?php

namespace App\Controller\Backend\Codex;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/codex/tag")
 */
class TagController extends Controller
{
    /**
     * @Route("/", name="backend_tag_index", methods="GET|POST")
     */
    public function index(Request $request): Response
    {
          //On récupère les tags
          $repository = $this->getDoctrine()->getRepository(Tag::class);
          $tags = $repository->findAll();
          //On crée le form mappé sur Tag
          $tag = new Tag();
          $form = $this->createForm(TagType::class, $tag);
          $form->handleRequest($request);
          // On vérifie que le form a été submit et est valide
          if($form->isSubmitted() && $form->isValid()){
              //On insère en database
              $em = $this->getDoctrine()->getManager();
              $em->persist($tag);
              $em->flush();
              // On redirige vers la page de la liste des tags
              return $this->redirectToRoute('backend_tag_index');
          }

          return $this->render('backend/codex/tag/index.html.twig', [
              'tags' => $tags,
              'tag' => $tag,
              'form' => $form->createView()
          ]);
    }

    /**
     * @Route("/{id}/edit", name="backend_tag_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_tag_index');
        }

        return $this->render('backend/codex/tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_tag_delete", methods="DELETE")
     */
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('backend_tag_index');
    }
}
