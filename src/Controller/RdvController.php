<?php

namespace App\Controller;

use App\Entity\RDV;
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
        $lesRDV = $repo->findByDate($date,$order);
        return $this->render('/rdv/index.html.twig', [
            'lesRDV' => $lesRDV,
        ]);
    }
}
