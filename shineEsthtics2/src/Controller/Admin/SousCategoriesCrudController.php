<?php

namespace App\Controller\Admin;

use App\Entity\SousCategories;
use App\Form\PieceJointeType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
        $libelle = TextField::new('libelle', 'Libellé');
        $cat = AssociationField::new('categories', 'Catégories');
        $slug = SlugField::new('slug')
            ->setTargetFieldName('libelle')
            ->onlyOnForms();

        $affichageSousCath = [$panelSousCath, $id, $libelle, $cat, $slug];
        $panelImages = FormField::addPanel('INFOS IMAGES');
        $nomPhoto = ImageField::new('nomPhoto')
            ->setFormType(VichFileType::class)
            ->setBasePath('/images/products')
            ->hideOnForm();

        $fichierPhoto = VichImageField::new('fichierPhoto', 'Photo')
            ->onlyOnForms();

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $affichageImages = [$panelImages, $nomPhoto, $fichierPhoto];
        } else {
            $affichageImages = [$panelImages, $nomPhoto, $fichierPhoto];
        }
        return array_merge($affichageSousCath, $affichageImages);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPaginatorPageSize(5)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste Sous-Categories')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une Sous-Cathegorie')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une Sous-Cathegorie')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Infos  une Sous-Cathegorie');
    }
}
