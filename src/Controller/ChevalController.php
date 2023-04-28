<?php


namespace App\Controller;
use App\Entity\RaceDeCheval;
use App\Entity\Client;
use App\Entity\Cheval;
use App\Form\ChevalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Nelmio\CorsBundle\NelmioCorsBundle;

class ChevalController extends AbstractController
{
    
    #[Route('/cheval/nouveau', name:'app_cheval_nouveau')]
    
    public function nouveau(Request $request, ManagerRegistry $doctrine): Response
    {

        $cheval = new Cheval();
        $form = $this->createForm(ChevalType::class, $cheval);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //En attendant la connexion client
            $client= $doctrine->getRepository(Client::class)->find(1);
            $cheval->setClient($client);

            //$entityManager = $this->getDoctrine()->getManager();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cheval);
            
            $entityManager->flush();

            $this->addFlash('success', 'Le cheval a été enregistré avec succès.');


            return $this->redirectToRoute('app_cheval_consulter', ['idCheval' => $cheval->getId()]);
        }

        return $this->render('cheval/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/cheval/consulter/{idCheval}', name:'app_cheval_consulter')]
    public function consulterCheval($idCheval, Request $request, ManagerRegistry $doctrine): Response
        {

       // Récupération du cheval correspondant à l'identifiant
             $cheval = $doctrine->getRepository(Cheval::class)->find(intval($idCheval));
         // Vérification si le cheval existe

         
        
        // Renvoi de la réponse avec les données du cheval
             return $this->render('cheval/consulter.html.twig', [
                 'cheval' => $cheval,
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


    #[Route('/cheval/lister', name: 'app_cheval_lister')]
    public function getLesChevals(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $chevals = $entityManager->getRepository(Cheval::class)->findAll();
       /* $ventes = $this->getDoctrine()
            ->getRepository(Vente::class)
            ->findAll();*/

        return $this->render('cheval/lister_chevals.html.twig', [
            'chevals' => $chevals,
        ]);
    }








}
