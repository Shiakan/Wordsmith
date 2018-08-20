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
     * @Route("/page/{page}", name="backend_room_index", requirements={"page" = "\d+"}, defaults={"page" = 1}, methods="GET")
     */
    public function index(RoomRepository $roomRepository, $page): Response
    {
        $limit = 5; //limite de questions par page (pagination)
        $rooms = $roomRepository->findByAll($page,$limit); //requête où on passe la page actuelle, le seeBanned et la limite de questions
        $totalRooms =  $roomRepository->findCountMax(); //requête qui compte le nombre total de questions avec ou sans les banned
        $pageMax = ceil($totalRooms / $limit); // nombre de page max à afficher (sert pour bouton suivant)
        return $this->render('backend/room/index.html.twig', [
            'rooms' => $rooms,
            'page'=>$page,
            'pageMax'=>$pageMax,
            ]);
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
