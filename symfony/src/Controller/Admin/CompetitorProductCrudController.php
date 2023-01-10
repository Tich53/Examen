<?php

namespace App\Controller\Admin;

use App\Entity\CompetitorProduct;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetitorProductCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return CompetitorProduct::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            /* ->renderSidebarMinimized() */
            ->setEntityPermission('ROLE_ADMIN')
            ->setPaginatorPageSize(20);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            NumberField::new('price'),
            AssociationField::new('competitor'),
            TextField::new('url'),
            TextField::new('raw_name')->onlyOnForms(),
            TextField::new('cleaned_name'),
            TextField::new('raw_reference')->onlyOnForms(),
            TextField::new('cleaned_reference'),
            TextField::new('raw_brand')->onlyOnForms(),
            TextField::new('cleaned_brand'),
            DateField::new('CreatedAt'),
            DateField::new('UpdatedAt'),
            DateField::new('DeletedAt')->onlyOnForms(),
        ];
    }
}
