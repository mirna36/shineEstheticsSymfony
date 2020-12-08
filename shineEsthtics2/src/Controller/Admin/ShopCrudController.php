<?php

namespace App\Controller\Admin;

use App\Entity\Shop;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shop::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $panelCath = FormField::addPanel('INFOS SHOP');
        $id = IdField::new('id', 'ID')->onlyOnIndex();
        $libelle = TextField::new('libelle','Libellé');
        $affichageCath = [$panelCath, $id, $libelle
        ];
        return array_merge($affichageCath);
    }
    public function configureCrud(Crud $crud): Crud{
        return parent::configureCrud($crud)
            ->setPaginatorPageSize(5)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste Shop Cathegorie')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une Cathegorie')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une Cathegorie')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Infos  une Cathegorie');


    }

}
