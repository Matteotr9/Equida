<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

        return $this->render('vente/index.html.twig', [
            'ventes' => $ventes,
        ]);
    }
}