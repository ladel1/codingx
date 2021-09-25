<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Event\MailerEvent;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EventDispatcherInterface $dispatcher): Response
    {
        $info="";
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        dump($form->isSubmitted()&&$form->isValid());
        dump($form->getData());
        if($form->isSubmitted()&&$form->isValid()){
            dd("cool");
            // lance event send contact        
            $dispatcher->dispatch(new MailerEvent("adel@codingx.tech",
                            $contact->getEmail(),
                            $contact->getSubject(),
                            "mailer/contact.html.twig",
                            ["email"=>$contact->getEmail(),
                            "content"=>$contact->getContent()]
                        ),MailerEvent::NAME);
            $info = "Votre email est bien envoyé!";
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'info' => $info,
        ]);
    }
}
