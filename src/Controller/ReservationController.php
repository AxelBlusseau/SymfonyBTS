<?php

namespace App\Controller;

use DateTime;
use App\Entity\Vol;
use App\Entity\Avion;
use App\Entity\Billet;
use App\Entity\Voyage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation/{idVoyage}", name="add_reservation")
     */
    public function add($idVoyage)
    {

        //Je récupère le voyage
        $entityManager = $this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getRepository(Voyage::class);
        $getVoyage=$repository->find($idVoyage);

        //Je récupère les données de l'utilisateur
        $user = $this->getUser();
        $date = new \DateTime('@'.strtotime('now'));

        //Je crée mon billet
        $billet=new Billet();
        $billet->setIdVoyage($getVoyage);
        $billet->setDateAchat($date);
        $billet->setPrix("355");
        $billet->setIdPassager($user);

        $entityManager->persist($billet);
        $entityManager->flush();

        //J'enlève une place de l'avion
        $getVols = $getVoyage->getIdVol();
        $avions = array();
        foreach($getVols as $vol){
             array_push($avions, $vol->getIdAvion());
        }

        foreach($avions as $avion){
            $getAvion=$this->getDoctrine()->getRepository(Avion::class)->find($avion);
            $getCapacite = $getAvion->getCapacite();
            $getAvion->setCapacite($getCapacite-1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($getAvion);
            $em->flush(); 
        }

        return $this->redirectToRoute("reservation");
    }

    /**
     * @Route("/reservations", name="reservation")
     */
    public function index()
    {
        $user = $this->getUser();

        $Billets = $this->getDoctrine()->getRepository(Billet::class)->findBy(array("id_Passager" => $user));    

        //Pour afficher le boutton "Annuler" uniquement sur les voyages prévus avant la date du jour.
        $datesMin = array();

        foreach($Billets as $billet){
        $getVoyage = $billet->getIdVoyage();
        $getVols = $getVoyage->getIdVol();

        $tabDatesDep = array();
            //Pour chacun des vols je récupère la date de départ et d'arrivée 
            foreach($getVols as $vol){   
                array_push($tabDatesDep, new DateTime($vol->getDateDepart()->format('Y-m-d') .' ' .$vol->getHeureDepart()->format('H:i:s')));

                //Je prends donc la plus petite date de chaque voyage
                $dateMin = min($tabDatesDep);
            }
            $datesMin[$billet->getId()] = $dateMin;
        }
        
        return $this->render('reservation/index.html.twig', [
            'billets' => $Billets,
            'datesMin' => $datesMin,
        ]);
    }

    /**
     * @Route("/reservations/supprimer{id}", name="billet_supprimer")
     */
    public function Supprimer($id)
    {
        //Je récupère le billet
        $Billets = $this->getDoctrine()->getRepository(Billet::class)->find($id);

        //Je le supprime
        $em=$this->getDoctrine()->getManager();
        $em->remove($Billets);
        $em->flush($Billets);

        $getVoyage = $Billets->getIdVoyage();

        //Je rajoute une place dans l'avion
        $getVols = $getVoyage->getIdVol();
        $avions = array();
        foreach($getVols as $vol){
             array_push($avions, $vol->getIdAvion());
        }

        foreach($avions as $avion){
            $getAvion=$this->getDoctrine()->getRepository(Avion::class)->find($avion);
            $getCapacite = $getAvion->getCapacite();
            $getAvion->setCapacite($getCapacite+1);

            $em=$this->getDoctrine()->getManager();
            $em->persist($getAvion);
            $em->flush(); 
        }
        return $this->redirectToRoute('reservation');
    }
}
