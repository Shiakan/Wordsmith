<?php

namespace App\Controller;

use App\Entity\Charactersheet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharactersheetController extends AbstractController
{
    /**
     * @Route("/charactersheet/{id}/show", name="character_sheet")
     */
    public function show(Charactersheet $charactersheet)
    {
        return new JsonResponse($charactersheet);
    }
}
