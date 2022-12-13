<?php

namespace App\Controller;

use App\Entity\RDV;
use App\Form\RDVType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RdvController extends AbstractController
{
    #[Route('/rdv', name: 'app_rdv')]
    public function getListeRDV(ManagerRegistry $doctrine,Request $request): Response
    {  
        $date = $request->query->get('date');
        $order = $request->query->get('order');
        $entityManager = $doctrine->getManager();
        $repo = $entityManager -> getRepository(RDV::class);
        $user = $this->getUser();

        if($this->isGranted('ROLE_MEDECIN')){
        $medecin= $user->getMedecin()->getId();
        } else{
            $medecin = $user->getAssistant()->getMedecin()->getId();
        }
        
        $lesRDV = $repo->findByDate($date,$order,$medecin);
        return $this->render('rdv/index.html.twig', [
            'lesRDV' => $lesRDV,
        ]);
    }
    #[Route('/rdv/{id}', name: 'modif_rdv')]
    public function modifRDV(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $em = $doctrine->getManager();
        $unRDV= $doctrine->getRepository(RDV::class)->find($id);

        $form = $this->createForm(RDVType::class, $unRDV);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($unRDV);
            $em->flush();
            return $this->redirectToRoute('app_rdv');
        }
        return $this->render('rdv/modif_rdv.html.twig', array(
            'form'=>$form->createView(),
            'unRDV'=> $unRDV,
        ));
    }

    #[Route('/', name: 'app_principal')]
    public function principal(): Response
    {
        return $this->render('principal/index.html.twig');
    }
}
