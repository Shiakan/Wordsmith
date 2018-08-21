<?php

namespace App\Controller;

use App\Entity\Charactersheet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharactersheetController extends AbstractController
{
    /**
     * @Route("/charactersheet/{id}/show", name="character_sheet")
     */
    public function show(Charactersheet $charactersheet)
    {
        return new JsonResponse($charactersheet);
    }

    /**
     * @Route("/charactersheet/{id}", name="character_sheet_edit")
     */
    public function update(Request $request, Charactersheet $charactersheet)
    {
        $data = $request->getContent();
        // $data = json_decode($data, true);

        // dump($data);die;
        // $data = $request->request->get('sheet-id');
        if($data != null) {
            $em = $this->getDoctrine()->getManager();
            
            $charactersheet->setContent($data);
            $em->flush();
            return $this->json($data);
            // return response($data);
        }
    }
}
