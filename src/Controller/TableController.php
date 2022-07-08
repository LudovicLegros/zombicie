<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\Survivant;
use App\Entity\TableGame;
use App\Repository\ProfilRepository;
use App\Repository\SurvivantRepository;
use App\Repository\TableGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TableController extends AbstractController
{
    #[Route('/table/{id}', name: 'detail_table')]
    public function index(TableGameRepository $repository, TableGame $table, $id): Response
    {
        
        // $thistable = $repository->find($id);
        return $this->render('table/tabledetail.html.twig', [
            'table' => $table,
        ]);
    }

    #[Route('/tablemanage/survivant_add/{ids}/{id}', name: 'survivant_add')]
    public function survivantAdd(Profil $profil, EntityManagerInterface $manager, SurvivantRepository $repo,$ids): Response
    {
        $thisTable =$profil->getTableParty()->getId();
        $survivant = $repo->find($ids);

        $profil->addProfilsurvivant($survivant);
        
        $manager->persist($profil);
        $manager->flush();


        return $this->redirectToRoute('detail_table' , [
            'id' => $thisTable
        ]);
    }
}
