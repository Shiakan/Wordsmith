<?php

namespace App\Controller\Backend;

use App\Entity\Room;
use App\Entity\User;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/backend/room")
 */
class RoomBackendController extends Controller
{
    /**
     * @Route("/", name="backend_room_index", methods="GET")
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('backend/room/index.html.twig', [
            'rooms' => $roomRepository->findAll()]);
    }

    /**
     * @Route("room/{id}", name="backend_room_delete", methods="DELETE")
     */
    public function delete(Request $request, Room $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($room);
            $em->flush();
        }

        return $this->redirectToRoute('backend_room_index');
    }
}
