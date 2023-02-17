<?php


namespace App\Controller;

use App\Entity\Cheval;
use App\Form\ChevalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChevalController extends AbstractController
{
    
    #[Route('/cheval/nouveau', name:'app_cheval_nouveau')]
    
    public function nouveau(Request $request): Response
    {
        $cheval = new Cheval();
        $form = $this->createForm(ChevalType::class, $cheval);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cheval);
            $entityManager->flush();

            $this->addFlash('success', 'Le cheval a été enregistré avec succès.');

            return $this->redirectToRoute('accueil');
        }

        return $this->render('cheval/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
    #[Route('/cheval/modifier/{id}', name:'app_cheval_modifier')]
    
    public function modifier(Request $request, Cheval $cheval): Response
    {
        $form = $this->createForm(ChevalType::class, $cheval);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Les informations sur le cheval ont été modifiées avec succès.');

            return $this->redirectToRoute('accueil');
        }

        return $this->render('cheval/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
