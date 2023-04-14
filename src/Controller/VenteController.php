<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CategorieDeVente;
use App\Entity\Vente;
use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\VenteType;

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


    #[Route('/vente/nouveau', name:'app_vente_nouveau')]
    
    public function nouveau(Request $request, ManagerRegistry $doctrine): Response
    {

        $vente = new Vente();
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //En attendant la connexion client
            $client= $doctrine->getRepository(Client::class)->find(1);
           

            //$entityManager = $this->getDoctrine()->getManager();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($vente);
            
            $entityManager->flush();

            $this->addFlash('success', 'La vente a été enregistré avec succès.');


            return $this->redirectToRoute('app_vente_consulter', ['idvente' => $vente->getId()]);
        }

        return $this->render('vente/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}