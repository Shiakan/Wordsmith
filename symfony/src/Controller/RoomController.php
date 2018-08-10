<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\User;
use App\Form\RoomType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */

    public function index(Request $request, ObjectManager $manager, UserInterface $user=null)
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class , $room);
        $form->handleRequest($request);
        $room->setDungeonmaster($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();
            return $this->redirectToRoute('room');
        }
        $repositoryRoom= $this->getDoctrine()->getRepository(Room::class);
        $repositoryUser= $this->getDoctrine()->getRepository(User::class);

        $users = $repositoryUser->findAll();
        $rooms = $repositoryRoom->findAll();

        return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
            'users'=>$users,
            'form'=>$form->createView(),
        ]);
    }
}
