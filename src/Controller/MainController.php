<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller /* class php pour la mise en place des pages généralistes */
{
    /**
     * @Route("/", name="homepage")
     */
    public function index() /* Fonction de la page d'acceuil du site */
    {
        return $this->render('main/index.html.twig'); /* Elle renvoie vers le fichier twig correspondant */
    }
        /**
     * @Route("/cgu", name="CGU")
     */
    public function cgu() /* Fonction de la page des Conditions générales d'utilisation */
    {
        return $this->render('main/cgu.html.twig'); /* Qui retourne le fichier twig statique correspondant */
    }
        /**
     * @Route("/about", name="about")
     */
    public function about() /* Fonction de la page A propos */
    {
        return $this->render('main/about.html.twig'); /* cette ligne permet de rediriger vers le fichier twig correspondant */
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request,ObjectManager $manager, \Swift_Mailer $mailer){ /* Fonction de la page contact, elle nécessite les class Request, ObjectManager et SwiftMailer pour bien fonctionner */
        $form = $this->createForm(ContactType::class); /* On lance la création du formulaire par le biais du contact form (ContactType) disponible dans le dossier Form */
        $form->handleRequest($request); /* Process des datas du formulaire */
        if ($form->isSubmitted() && $form->isValid()) { /* Si le form est envoyer et qu'il réponds aux contraintes (il est alors valide) alors  */
            $data = $form->getData(); /* On définie $data comme étant un tableau assosiatif contenant toutes les données du formulaire via $form->getData() */
            $username = $data["username"]; /*$username est définie via le tableau assosiatif data à la clé username  */
            $mail = $data["mail"]; /* $mail est définie via le tableau assosiatif data à la clé mail */
            $sujet = $data["sujet"]; /* $sujet est définie via le tableau assosiatif data à la clé sujet*/
            $content = $data["content"]; /*$content est définie via le tableau assosiatif data à la clé content */
            $message = (new \Swift_Message('Hello Mail')) //On instancie Swift Mailer
                    ->setSubject($sujet) //On définie le sujet du mail
                    ->setFrom($mail) //On définie l'expéditeur
                    ->setTo("projetkelnor@gmail.com") //Grâce à l'enregistrement, on définie le destinataire
                    ->setContentType("text/html") //On définie que le contenue est un mail html
                    ->setBody(  //On définie le body comme étant
                        $this->renderView('emails/contact.html.twig', /* Ce template */
                            ['username'=>$username, /* Auquel on passe le paramètre username */
                            'content'=>$content, /* Auquel on passe le paramètre content */
                            'mail'=>$mail, /* Auquel on passe le paramètre mailç */
                        ]
                    )
            );
            //On envoie le mail
            $mailer->send($message);
            return $this->redirectToRoute('homepage'); /* une fois le mail envoyer, on redirige l'utilisateur vers la page d'acceuil */
        }
        return $this->render('main/contact.html.twig',[ /* On dirige la fonction vers un fichier qui sert de rendu */ 
            'form' =>$form->createView() /* On lui passe également en paramètre le formulaire de contact précédement créé  */
        ]);
    }
}
