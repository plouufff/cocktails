<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

/**
 * @extends AbstractCrudController<Ingredient>
 */
class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ingredients.singular')
            ->setEntityLabelInPlural('ingredients.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'shared.id')->setDisabled();
        yield TextField::new('name', 'shared.name');
        yield AssociationField::new('ingredientCategory', 'ingredient_categories.singular');
        yield DateTimeField::new('createdAt', 'shared.createdAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
        yield DateTimeField::new('updatedAt', 'shared.updatedAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(EntityFilter::new('ingredientCategory', 'ingredient_categories.singular'));
    }
}
