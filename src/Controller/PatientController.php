<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
use App\Form\PatientType;

=======
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RDV;
use App\Entity\Statut;
use App\Form\RDVType;
use Doctrine\Persistence\ManagerRegistry;
>>>>>>> 126c2038c56ab7d783ae4937d1dba1ed41d507c3

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(): Response
    {
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }

    #[Route('/patient/prendre-rdv', name: 'app_create_rdv')]
    public function prendreRdv(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $statut = $doctrine->getRepository(Statut::class)->find(1);

        $rdv = new RDV();
        $form = $this->createForm(RDVType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $rdv->setPatient($this->getUser()->getPatient());
            $rdv->setStatut($statut);
            $rdv->setDuree(15);

            $entityManager->persist($rdv);
            $entityManager->flush();

            return $this->redirectToRoute('app_principal');
        }

        return $this->render('rdv/createRdv.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
