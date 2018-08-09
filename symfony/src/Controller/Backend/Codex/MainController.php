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
 * @Route("/backend/codex")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="backend_codex_index")
     */
    public function index()
    {
        return $this->render('backend/codex/index.html.twig');
    }
}
