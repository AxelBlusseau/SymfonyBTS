<?php

namespace App\Controller;

use DateTime;
use App\Entity\Vol;
use App\Entity\Classe;
use App\Entity\Trajet;
use App\Entity\Voyage;
use App\Entity\Aeroport;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchVoyageController extends AbstractController
{

    /**
     * @Route("/search/voyage", name="search_voyage")
     */
    public function index()
    {
        //Je récupère les données saisies par l'utilisateur
        $depart = $_POST["depart"];
        $arrive = $_POST["arrive"];
        $date = $_POST["date"];
        $classe = $_POST["classe"];

        //Je récupère tous les voyages
        $getVoyages = $this->getDoctrine()->getRepository(Voyage::class)->findAll();
       
        $villeDep;
        $villeArr;
        $tabVoyages = array();

        //Pour chaque voyage que j'ai récupéré 
        foreach($getVoyages as $voyage){
            $tabVilleDep = array();
            $tabVilleArr = array();

            //Je prend les vols liés à un voyage
            $tabVol = $voyage->getIdVol();

            //Pour chacun d'eux je récupère la date de départ et d'arrivée 
            foreach($tabVol as $vol){   
                array_push($tabVilleDep, new DateTime($vol->getDateDepart()->format('Y-m-d') .' ' .$vol->getHeureDepart()->format('H:i:s')));
                array_push($tabVilleArr, new DateTime($vol->getDateArrive()->format('Y-m-d') .' ' .$vol->getHeureArrive()->format('H:i:s')));

                //Je prends donc la plus petite et la plus grande date de chaque voyage
                $dateMin = min($tabVilleDep);
                $dateMax = max($tabVilleArr);

                //Je prends les villes correspondantes
                $villeDep = $this->getDoctrine()->getRepository(Vol::class)->findDepartMin($dateMin->format('Y-m-d'), $dateMin->format('H:i:s'), $voyage->getIdVoyage());
                $villeArr = $this->getDoctrine()->getRepository(Vol::class)->findDepartMax($dateMax->format('Y-m-d'), $dateMax->format('H:i:s'), $voyage->getIdVoyage());
            }
            //Si les villes et la date de départ correspondent aux données renseignées par l'utilisateur je les affiches
            if($villeDep['ville'] == $depart && $villeArr['ville'] == $arrive && $dateMin->format('Y-m-d') == $date){
              array_push($tabVoyages, $this->getDoctrine()->getRepository(Voyage::class)->find($voyage->getIdVoyage()));
            }
        }

        $repositoryClasse=$this->getDoctrine()->getRepository(Classe::class);
        $getClasse=$repositoryClasse->find($classe);

        return $this->render('search_voyage/index.html.twig', [
            'voyageDepart' => $depart,
            'voyageArrive' => $arrive,
            'classe' => $getClasse,
            'voyages' => $tabVoyages,
        ]);
    }

    /**
     * @Route("/search/details/{idVoyage}/{idClasse}", name="voyage_details")
     */
    public function recupVoyage($idVoyage, $idClasse)
    {

        $repository=$this->getDoctrine()->getRepository(Voyage::class);

        $getVoyage=$repository->find($idVoyage);

        $getVols = array();
        $getClasse = array();
        $getPrix = 0;
        $pr = "";
        $dateMin = "";
        $dateMax = "";
        $error = 0;

        if($getVoyage != null){

            $getVols=$getVoyage->getIdVol();

            //Calcul du prix du voyage
            $repositoryClasse=$this->getDoctrine()->getRepository(Classe::class);
            $getClasse = $repositoryClasse->find($idClasse);

            if($getClasse != null){

                $getPrix = $getVoyage->getPrix() + $getClasse->getPrix();

                //Calcul du nombre de place restante pour les vols uniques
                $billets = $getVoyage->getBillets();
                $nbBillets = 0;
                foreach($billets as $billet){
                    $nbBillets++;
                }

                if($getVoyage->getEscale() == 0){
                    $tabVol = $getVoyage->getIdVol();
                    foreach($tabVol as $vol){
                    $avion = $vol->getIdAvion();
                    }
                    $pr = $avion->getCapacite();
                }

                //Dates de départ et d'arrivées.       
                $tabVol = $getVoyage->getIdVol();
                $dateDepartVoy = array();
                $dateArriveeVoy = array();
                foreach($tabVol as $vol){
                        array_push($dateDepartVoy, $vol->getDateDepart()->format('d-m-Y'));
                        array_push($dateArriveeVoy, $vol->getDateArrive()->format('d-m-Y'));

                        $dateMin = min($dateDepartVoy);
                        $dateMax = max($dateArriveeVoy);
                }
            }else{ $error = 1; }
        }else{ $error = 1; }
        
        return $this->render('search_voyage/recapvoy.html.twig', [
            'voyage' => $getVoyage,
            'vols' => $getVols,
            'classe' => $getClasse,
            'prix' => $getPrix,
            'place_restante' => $pr,
            'dateMin' => $dateMin,
            'dateMax' => $dateMax,
            'error' => $error,
        ]);
    }
}
