<?php

namespace App\Controller;

use App\Entity\TableGame;
use App\Repository\TableGameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TableController extends AbstractController
{
    #[Route('/table/{id}', name: 'detail_table')]
    public function index(TableGameRepository $repository, $id): Response
    {
        $thistable = $repository->find($id);
        return $this->render('table/tabledetail.html.twig', [
            'table' => $thistable,
        ]);
    }
}
