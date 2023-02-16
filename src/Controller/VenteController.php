<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VenteController extends AbstractController
{
    #[Route('/vente', name: 'app_vente')]
    public function index(): Response
    {
        $ventes = $this->getDoctrine()
            ->getRepository(Vente::class)
            ->findAll();

        return $this->render('vente/index.html.twig', [
            'ventes' => $ventes,
        ]);
    }
}