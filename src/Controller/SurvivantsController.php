<?php

namespace App\Controller;

use App\Repository\SurvivantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurvivantsController extends AbstractController
{
    #[Route('/survivants', name: 'survivants')]
    public function index(SurvivantRepository $repository): Response
    {
        $survivants = $repository->findAll();
        return $this->render('survivants/index.html.twig', [
            'survivants' => $survivants,
        ]);
    }
}
