<?php

namespace App\Controller\Admin;

use App\Entity\Race;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Classe;
use App\Entity\Survivant;
use App\Entity\TableGame;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zombicide');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Gestion utilisateurs', 'fa-solid fa-circle-user', User::class);
        yield MenuItem::linkToCrud('Liste des compétences', 'fa-solid fa-book', Skill::class);
        yield MenuItem::linkToCrud('Liste des survivants', 'fa-solid fa-person', Survivant::class);
        yield MenuItem::linkToCrud('Liste des races', 'fa-solid fa-person-circle-question', Race::class);
        yield MenuItem::linkToCrud('Liste des rôles', 'fa-solid fa-person-dots-from-line', Classe::class);
        yield MenuItem::linkToCrud('Gestion table', 'fa-solid fa-campground', TableGame::class);
    }
}
