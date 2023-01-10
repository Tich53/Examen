<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Website;
use App\Entity\Category;
use App\Entity\Competitor;
use App\Entity\CompetitorProduct;
use App\Entity\ProductPriceHistorical;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CompetitorProductPriceHistorical;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

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
        return $this->render('/Admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Spy & Compare');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Catégories', 'fa fa-tags', Category::class);
        /* yield MenuItem::subMenu('Catégories', 'fas fa-tags')->setSubItems([
            MenuItem::linkToCrud('Add Category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)]); */
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
        /*         yield MenuItem::subMenu('Tags', 'fas fa-tags')->setSubItems([
            MenuItem::linkToCrud('Add Tag', 'fas fa-plus', Tag::class)->setAction(Crud::PAGE_NEW)]); */
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-id-card', User::class);
        yield MenuItem::linkToCrud('Sites Web', 'fas fa-list', Website::class);
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Catalogues clients', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Historique clients', 'fas fa-list', ProductPriceHistorical::class);
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Concurrents', 'fa fa-id-card', Competitor::class);
        yield MenuItem::linkToCrud('Catalogues concurrents', 'fas fa-list', CompetitorProduct::class);
        yield MenuItem::linkToCrud('Historique concurrents', 'fas fa-list', CompetitorProductPriceHistorical::class);

    }
}
