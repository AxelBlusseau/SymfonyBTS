<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Entity\Aeroport;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        //Je récupère les aeroports pour les afficher dans mon formulaire
        $getAeroport = $this->getDoctrine()->getRepository(Aeroport::class)->findAll();

        $villeDisplayed = array();

        foreach($getAeroport as $ville){
            array_push($villeDisplayed, $ville->getVille());
        }

        return $this->render('main/index.html.twig', [
            'villes' => $villeDisplayed,
        ]);
    }
}
