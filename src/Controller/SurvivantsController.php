<?php

namespace App\Controller;


use App\Entity\Race;
use App\Entity\SurvivantFilter;
use App\Form\SurvivantFilterType;
use App\Repository\SurvivantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurvivantsController extends AbstractController
{
    #[Route('/survivants', name: 'survivants')]
    public function index(SurvivantRepository $repository, Request $request): Response
    {   
        $survivantFilter = new SurvivantFilter;
        $form = $this->createForm(SurvivantFilterType::class, $survivantFilter);
        $form->handleRequest($request);
        
        //Affichage des survivants
        $survivants = $repository->getFilter($survivantFilter);
        
        return $this->render('survivants/survivants.html.twig', [
            'survivants' => $survivants,
            'form' => $form->createView(),
        ]);
    }
}
