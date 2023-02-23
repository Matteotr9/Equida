<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vente;
use Doctrine\Persistence\ManagerRegistry;

class VenteController extends AbstractController
{
    #[Route('/vente/lister', name: 'app_vente_lister')]
    public function getLesVentes(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $ventes = $entityManager->getRepository(Vente::class)->findAll();
       /* $ventes = $this->getDoctrine()
            ->getRepository(Vente::class)
            ->findAll();*/

        return $this->render('vente/lister_ventes.html.twig', [
            'ventes' => $ventes,
        ]);
    }


    #[Route('/vente/consulter/{idvente}', name:'app_vente_consulter')]
    public function consulterVente($idvente, Request $request, ManagerRegistry $doctrine): Response
        {

       // Récupération du cheval correspondant à l'identifiant
             $ventes = $doctrine->getRepository(Vente::class)->find(intval($idvente));
         // Vérification si le cheval existe

         
        
        // Renvoi de la réponse avec les données du cheval
             return $this->render('vente/consulter.html.twig', [
                 'ventes' => $ventes,
    ]);

    }
}