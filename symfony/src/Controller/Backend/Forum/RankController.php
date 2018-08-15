<?php

namespace App\Controller\Backend\Forum;



use App\Entity\Rank;
use App\Form\RankType;
use App\Repository\RankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rank")
 */
class RankController extends Controller
{
    /**
     * @Route("/", name="backend_rank_index", methods="GET|POST")
     */
    public function index(RankRepository $rankRepository, Request $request): Response
    {
        //On récupère les rangs
        $repository = $this->getDoctrine()->getRepository(Rank::class);
        $ranks = $repository->findAll();
        //On crée le form mappé sur Rank
        $rank = new Rank();
        $form = $this->createForm(RankType::class, $rank);
        $form->handleRequest($request);
          // On vérifie que le form a été submit et est valide
        if ($form->isSubmitted() && $form->isValid()) {
              //On insère en database
            $em = $this->getDoctrine()->getManager();
            $em->persist($rank);
            $em->flush();
            // On redirige vers la page de la liste des tags
            return $this->redirectToRoute('backend_rank_index');
        }
        return $this->render('backend/forum/rank/index.html.twig', [
            'ranks' => $ranks,
            'rank'  => $rank,
            'form'  => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="backend_rank_edit", methods="GET|POST")
     */
    public function edit(Request $request, Rank $rank): Response
    {
        $form = $this->createForm(RankType::class, $rank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("backend_rank_index");
        }

        return $this->render('backend/forum/rank/edit.html.twig', [
            'rank' => $rank,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_rank_delete", methods="DELETE")
     */
    public function delete(Request $request, Rank $rank): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rank->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rank);
            $em->flush();
        }

        return $this->redirectToRoute('backend_rank_index');
    }
}
