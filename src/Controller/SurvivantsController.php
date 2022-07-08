<?php

namespace App\Controller;


use App\Entity\Race;
use App\Entity\Profil;
use App\Entity\TableGame;
use App\Entity\SurvivantFilter;
use App\Form\SurvivantFilterType;
use App\Repository\ProfilRepository;
use App\Repository\SurvivantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurvivantsController extends AbstractController
{
    #[Route('/survivants', name: 'survivants')]
    #[Route('/survivantsadd/{id}', name:'survivant_route')]
    public function index(SurvivantRepository $repository,ProfilRepository $repo, Request $request,Profil $profil = null): Response
    {   
        $survivantFilter = new SurvivantFilter;
        $form = $this->createForm(SurvivantFilterType::class, $survivantFilter);
        $form->handleRequest($request);
        
        //Affichage des survivants
        $survivants = $repository->getFilter($survivantFilter);

        //BLOC TESSTT-----
        // dd($profil);
        // $allow = 0;
        if($profil != null){
              
            // $tests = $repo->findBy(['tableParty' => $id]);
            // dd($table);
            // foreach($table->getProfils() as $guest){
            //     // dd($guest);
                if($profil->getPlayer()->getId() == $this->getUser()->getId()){
            //         $allow = 1;
            //         break;          
                }else{
                    return $this->redirectToRoute('survivants');
                }

            //     if($allow = 0){
            //         return $this->redirectToRoute('survivants');
            //     }
            // }
        }
        //BLOC TESSTT-----
        
        return $this->render('survivants/survivants.html.twig', [
            'survivants'    => $survivants,
            'form'          => $form->createView(),
            'profil'        => $profil,
            // 'tableId'       => $this->getProfil(),
        ]);
    }

        // #[Route('/survivants/{id}', name:'survivant_route')]
        // public function verifSurvivant($id, ProfilRepository $repo): Response
        // {   

        //     $tests = $repo->findBy(['tableParty' => $id]);
        //     $allow = 0;
        //     foreach($tests as $test){
        //         // dd($this->getUser()->getId());
        //         if($test->getPlayer()->getId() == $this->getUser()->getId()){
        //             $allow = 1;
        //             break;          
        //         }

        //         if($allow = 1){

        //         }else{
        //             return $this->redirectToRoute('home');
        //         }
        //     }

        //     return $this->render('survivants/survivants.html.twig', [
        
        //     ]);
        // }
}
