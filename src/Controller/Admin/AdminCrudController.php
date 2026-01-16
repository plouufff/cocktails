<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

/**
* @extends AbstractCrudController<Admin>
*/
class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('admins.singular')
            ->setEntityLabelInPlural('admins.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'shared.id')->setDisabled();
        yield EmailField::new('email', 'shared.email');
        yield ArrayField::new('roles', 'admin.roles');
        yield DateTimeField::new('createdAt', 'shared.createdAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
        yield DateTimeField::new('updatedAt', 'shared.updatedAt')
            ->setFormat(DateTimeField::FORMAT_SHORT, DateTimeField::FORMAT_SHORT)->hideOnForm();
    }
}
