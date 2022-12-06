<?php

namespace App\Controller;

use App\Entity\RDV;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CabinetController extends AbstractController
{
    #[Route('/cabinet', name: 'app_cabinet')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getRepository(RDV::class);
        $lesRDV = $em->findAll();
        return $this->render('/cabinet/index.html.twig', [
            'lesRDV' => $lesRDV,
        ]);
    }
}
