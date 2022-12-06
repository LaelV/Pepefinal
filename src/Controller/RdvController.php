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
    public function index(ManagerRegistry $doctrine,Request $request): Response
    {
        $data = $request->request->get('post');
        $data ='r.date';
        
        $entityManager = $doctrine->getManager();
        $repo = $entityManager -> getRepository(RDV::class);
        $queryBuilder = $repo->createQueryBuilder('tri');
        $queryBuilder
        ->select(array('p.nom','s.libelle','r.duree','r.date','r.heure'))
        ->from(RDV::class,'r')
        ->innerjoin('r.patient','p')
        ->innerjoin('r.statut','s')
        ->addOrderBy($data, 'ASC');

        $lesRDV = $queryBuilder->getQuery()->getResult();
        return $this->render('/rdv/index.html.twig', [
            'lesRDV' => $lesRDV,
        ]);
    }
}
