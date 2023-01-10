<?php

namespace App\Controller\Admin;

use App\Entity\ProductPriceHistorical;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductPriceHistoricalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductPriceHistorical::class;
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
            DateField::new('CreatedAt'),
            DateField::new('UpdatedAt'),
            DateField::new('DeletedAt')->onlyOnForms(),
        ];
    }
}
