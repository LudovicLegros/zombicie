<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\TableGame;
use App\Repository\ProfilRepository;
use App\Repository\TableGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TableGameRepository $repository, ProfilRepository $profilrepo): Response
    {
        $noUser     = 0;
        $existUser  = 1;
        $tables     = $repository->findAll();
        // $count      = $repository->count([$this->getUser()->getUsername()]);
        // $tests     = $profilrepo->test($this->getUser()->getId());
        // $tests      = $profilrepo->findById($this->getUser()->getId());

        // dd($profilrepo->countTable($this->getUser()->getId()));

        if($this->getUser()!== null){
            $count = $profilrepo->countTable($this->getUser()->getId());
            return $this->render('home/index.html.twig', [
                'tables'=>$tables,
                // dd($tables)
                'count'=>$count, 
                'existuser'=>$existUser      
            ]);
        }else{
            return $this->render('home/index.html.twig', [
                'tables'=>$tables, 
                'existuser'=>$noUser   
            ]);
        }
        
     
    }

    #[Route('/join_table/{id}', name: 'join_table')]
    public function joinTable(EntityManagerInterface $manager, TableGame $table)
    {
        $profil = new Profil;
        $profil->setPlayer($this->getUser());
        // dd($table->getId());
        $profil->setTableParty($table);
       
        

        $manager->persist($profil);
        $manager->flush();

        return $this->redirectToRoute('home');
    }
}
