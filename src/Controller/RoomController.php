<?php

namespace App\Controller;
use App\Entity\Room;
use App\Entity\User;
use App\Form\RoomType;
use App\Form\CharacterNameType;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RoomController extends Controller
{
    /**
     * @Route("room", name="room_index", methods="GET")
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('room/index.html.twig', [
            'rooms' => $roomRepository->findAll()]);
    }
    /**
     * @Route("room/new", name="room_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user, \Swift_Mailer $mailer)
    {   
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);
        $code = $this->createRandomCode();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $room->setDungeonmaster($user);
            $room->setCode($code);
            $em->persist($room);
            $em->flush();
            /*MAIL TO PARTICIPANTS*/
            foreach ($room->getParticipants() as $participant) {
                $message= (new \Swift_Message('Hello Mail')) //On instancie Swift Mailer
                        ->setSubject('Vous avez été invité par '.$room->getDungeonmaster()->getUsername().'') //On définie le sujet du mail
                        ->setFrom('projetkelnor@gmail.com') //On définie l'expéditeur
                        ->setTo($participant->getEmail()) //Grâce à l'enregistrement, on définie le destinataire
                        ->setContentType("text/html") //On définie que le contenue est un mail html
                        ->setBody(  //On définie le body comme étant
                            $this->renderView('emails/roomJoined.html.twig', //Ce fichier twig
                                ['user'=>$user,
                                'room'=>$room,
                                 'participant'=>$participant,
                                 'code'=>$code,
                                ] //On lui passe user
                            )
                        );
                        //On envoie le mail
                        $mailer->send($message);
            }
            return $this->redirectToRoute('room_show', ['code' => $code ]);
        
        }
        return $this->render('room/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }
    
    private function createRandomCode() { 
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= 10) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
    
        return $pass; 
    } 

    /**
     * @Route("room/{code}", name="room_show", methods="GET|POST")
     */
    public function show(Room $room, UserInterface $user, Request $request): Response
    {
        // $participants = $room->getParticipants();
        // On récupère les participants
        $repository = $this->getDoctrine()->getRepository(User::class);
        $participant = $repository->findParticipants($room, $user);
        // dump($participant);die;
        if($participant !== null || $room->getDungeonmaster()->getId()  == $user->getId()){
            if($user->getCharacterProfile()->getCharacterName() == null) {
                $characterProfile = $user->getCharacterProfile();
                $form = $this->createForm(CharacterNameType::class, $characterProfile);
                $form->handleRequest($request);
        
                if ($form->isSubmitted() && $form->isValid()) {
                    $this->getDoctrine()->getManager()->flush();
        
                    return $this->redirectToRoute('room_show', ['code' => $room->getCode()]);
                }
                return $this->render('forum/character_profile/edit_name.html.twig', [
                    'form' => $form->createView(),
                    'characterProfile' => $characterProfile
                ]);
            } else {
                return $this->render('room/index.html.twig', [
                        'room' => $room
                    ]);
            }
        }
        else{
            return $this->render('room/error.html.twig');
        }
    }

    /**
     * @Route("room/{id}/edit", name="room_edit", methods="GET|POST")
     */
    public function edit(Request $request, Room $room): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('room_edit', ['id' => $room->getId()]);
        }
        return $this->render('room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("room/{id}", name="room_delete", methods="DELETE")
     */
    public function delete(Request $request, Room $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($room);
            $em->flush();
        }
        return $this->redirectToRoute('room_index');
    }
}
