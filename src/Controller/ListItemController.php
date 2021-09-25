<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListItemController extends AbstractController
{
    #[Route('/list/item', name: 'list_item')]
    public function index(Request $request,ItemRepository $repository): Response
    {
        $search=$request->query->get("s");
        $liste = array();
        if(!empty($search)){
            $liste=$repository->findByTitre($search);
        }else{
            $liste=$repository->findAll();                    
        }
        return $this->render('list_item/index.html.twig', [
            'items' => $liste,
        ]);
    }

    #[Route('/delete/item', name: 'delete_item')]
    public function delete(Request $request,ItemRepository $repository, EntityManagerInterface $em): Response
    {
        if($request->isMethod("POST")){
            $id_item = $request->request->get("id");
            if(!empty($id_item)){
                $item = $repository->find($id_item);
                $em->remove($item);
                $em->flush();
            }
        }
        return $this->redirect("/list/item");
    }


}
