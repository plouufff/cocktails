<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
// use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cocktails')
            ->setTranslationDomain('admin')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('menu.general');
        yield MenuItem::linkToDashboard('menu.admin_home', 'fa fa-home');
        yield MenuItem::linkToRoute('menu.website_home', 'fa fa-globe', 'homepage');

        yield MenuItem::section('menu.cocktails');
        yield MenuItem::linkToCrud('cocktails.plural', 'fa fa-cocktail', Cocktail::class);
        yield MenuItem::linkToCrud('ingredients.plural', 'fa fa-blender', Ingredient::class);
        yield MenuItem::linkToCrud('ingredient_categories.plural', 'fa fa-tags', IngredientCategory::class);

        yield MenuItem::section('menu.administration');
        // yield MenuItem::linkToCrud('users.plural', 'fa fa-users', User::class);
    }
}
