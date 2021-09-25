<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig');

    }
    #[Route('/creation-de-site-web', name: 'page2')]
    public function page2(Request $request): Response
    {
        return $this->render('pages/creation-de-site-web.html.twig');

    }
    #[Route('/developpement-specifique', name: 'page3')]
    public function page3(Request $request): Response
    {
        return $this->render('pages/developpement-specifique.html.twig');

    }
    #[Route('/developpement-mobile', name: 'page4')]
    public function page4(Request $request): Response
    {
        return $this->render('pages/developpement-mobile.html.twig');

    }
    #[Route('/formation', name: 'formation')]
    public function formation(Request $request): Response
    {
        return $this->render('pages/formation.html.twig');

    }    
    #[Route('/technologies', name: 'page5')]
    public function page5(Request $request): Response
    {
        return $this->render('pages/technologies.html.twig');

    }
}


