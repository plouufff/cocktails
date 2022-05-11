<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Form\CocktailIngredientType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CocktailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cocktail::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('cocktails.singular')
            ->setEntityLabelInPlural('cocktails.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'shared.id')->setDisabled();
        yield TextField::new('name', 'shared.name');
        yield TextField::new('slug', 'cocktails.slug');
        yield AssociationField::new('cocktailIngredients', 'cocktails.ingredients')->onlyOnIndex();
        yield CollectionField::new('cocktailIngredients', 'cocktails.ingredients')->allowAdd()->setEntryType(CocktailIngredientType::class)->hideOnIndex();
        yield TextEditorField::new('recipe', 'cocktails.recipe');
        yield DateTimeField::new('createdAt', 'shared.createdAt')->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
        yield DateTimeField::new('updatedAt', 'shared.updatedAt')->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
    }
}
