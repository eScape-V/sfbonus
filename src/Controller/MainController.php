<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_accueil")
     */
    public function accueil()
    {
        return $this->render('main/accueil.html.twig');
    }

    /**
     * @Route("/liste", name="main_liste")
     */
    public function liste()
    {
        return $this->render('main/liste.html.twig');
    }

}