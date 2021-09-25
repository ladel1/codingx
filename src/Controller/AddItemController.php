<?php

namespace App\Controller;

use App\Entity\Item;
use App\Event\ExampleEvent;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddItemController extends AbstractController
{

    #[Route('/add/item', name: 'add_item')]
    public function index(Request $request,
     EntityManagerInterface $em
     ): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class,$item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $item->getImage();
            $item->setImage($file->getClientOriginalName());

            $em->persist($item);
            $em->flush();

            $file->move($this->getParameter('upload_directory'),$item->getId().".".$file->guessExtension());


        }

        return $this->render('add_item/index.html.twig', ["form"=>$form->createView()]);

    }
}




// MailerInterface $mailer
// $upload = new Upload();
// $form = $this->createForm(UploadType::class, $upload);

// $form->handleRequest($request);
// if($form->isSubmitted() && $form->isValid()){
//     $file = $upload->getName();
//     $filename = md5(uniqid()).'.'.$file->guessExtension();
//     $file->move($this->getParameter('upload_directory'),$filename);           
//     $upload->setName($filename);
//     $email = new Email();
//     $email->from("support@cfim.com")
//           ->to("adel.latibi@gmail.com")
//           ->subject("Formation Symfony 5")
//           ->html("<h1>Hello You!</h1>");                           
//     $mailer->send($email);
// }  
//, EventDispatcherInterface $ed  
//  $ed->dispatch( new ExampleEvent($item),ExampleEvent::NAME);
