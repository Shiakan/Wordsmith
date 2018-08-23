<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }
        /**
     * @Route("/cgu", name="CGU")
     */
    public function cgu()
    {
        return $this->render('main/cgu.html.twig');
    }
        /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request,ObjectManager $manager, \Swift_Mailer $mailer){
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $username = $data["username"];
            $mail = $data["mail"];
            $sujet = $data["sujet"];
            $content = $data["content"];
                $message = (new \Swift_Message('Hello Mail')) //On instancie Swift Mailer
            ->setSubject($sujet) //On définie le sujet du mail
            ->setFrom($mail) //On définie l'expéditeur
            ->setTo("projetkelnor@gmail.com") //Grâce à l'enregistrement, on définie le destinataire
            ->setContentType("text/html") //On définie que le contenue est un mail html
            ->setBody(  //On définie le body comme étant
                $this->renderView('emails/contact.html.twig', //Ce fichier twig
                    ['username'=>$username,
                     'content'=>$content,
                     'mail'=>$mail,
                    ])
            );
        //On envoie le mail
        $mailer->send($message);
            return $this->redirectToRoute('homepage');
        }
        return $this->render('main/contact.html.twig',[
            'form' =>$form->createView()
        ]);
    }
}
