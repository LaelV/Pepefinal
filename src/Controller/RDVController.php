<?php

namespace App\Controller;

use App\Entity\Assistant;
use App\Entity\Medecin;
use App\Entity\RDV;
use App\Form\AssistantType;
use App\Form\MedecinType;
use App\Form\RDVType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RDVController extends AbstractController
{
    #[Route('/rdvs', name: 'listes_rendez_vous')]
    public function listRDV(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(RDV::class);
        $lesRDV = $repository->findAll();
        return $this->render('principal/rdv.html.twig', [
            'lesRDV' => $lesRDV,
        ]);
    }

    #[Route('/rdv/{id}', name: 'modif_rdv')]
    public function modifRDV(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $em = $doctrine->getManager();
        $rdv = $doctrine->getRepository(RDV::class)->find($id);

        $form = $this->createForm(RDVType::class, $rdv);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute('listes_rendez_vous');
        }
        return $this->render('principal/ajouter_rdv.html.twig', array(
            'form'=>$form->createView(),
            'rdv'=> $rdv,
        ));
    }

}
?>