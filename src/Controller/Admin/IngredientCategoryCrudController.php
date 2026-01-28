<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\IngredientCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<IngredientCategory>
 */
class IngredientCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return IngredientCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ingredient_categories.singular')
            ->setEntityLabelInPlural('ingredient_categories.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'shared.id')->setDisabled();
        yield TextField::new('name', 'shared.name');
        yield AssociationField::new('ingredients', 'ingredients.plural')->autocomplete();
        yield DateTimeField::new('createdAt', 'shared.createdAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
        yield DateTimeField::new('updatedAt', 'shared.updatedAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
    }
}
