<?php

namespace App\Controller\Codex;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CodexController extends Controller
{
    /**
     * @Route("/codex", name="codex")
     */
    public function index()
    {
        return $this->render('codex/index.html.twig', [
            'controller_name' => 'CodexController',
        ]);
    }
}
