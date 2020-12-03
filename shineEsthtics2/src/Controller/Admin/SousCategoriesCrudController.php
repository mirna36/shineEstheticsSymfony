<?php

namespace App\Controller\Admin;

use App\Entity\SousCategories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SousCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousCategories::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $panelSousCath = FormField::addPanel('INFOS SOUS-CATHEGORIES');
        $id = IdField::new('id', 'ID')->onlyOnIndex();
        $libelle = TextField::new('libelle','Libellé');
        $affichageSousCath = [$panelSousCath, $id, $libelle
        ];
        return array_merge($affichageSousCath);
    }
    public function configureCrud(Crud $crud): Crud{
        return parent::configureCrud($crud)
            ->setPaginatorPageSize(5)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste Sous-Categories')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une Sous-Cathegorie')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une Sous-Cathegorie')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Infos  une Sous-Cathegorie');


    }

}
