<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
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

        yield MenuItem::section('menu.cocktails');
        yield MenuItem::linkTo(CocktailCrudController::class, 'cocktails.plural', 'fa fa-cocktail');
        yield MenuItem::linkTo(IngredientCrudController::class, 'ingredients.plural', 'fa fa-blender');
        yield MenuItem::linkTo(IngredientCategoryCrudController::class, 'ingredient_categories.plural', 'fa fa-tags');

        yield MenuItem::section('menu.administration');
        yield MenuItem::linkTo(AdminCrudController::class, 'admins.plural', 'fa fa-users');
    }
}
