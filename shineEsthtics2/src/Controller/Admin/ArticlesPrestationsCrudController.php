<?php

namespace App\Controller\Admin;

use App\Entity\ArticlesPrestations;
use App\Form\PieceJointeType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticlesPrestationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticlesPrestations::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $panelArticles = FormField::addPanel('INFOS ARTICLE/PRESTATION');
        $id = IdField::new('id', 'ID')->onlyOnIndex();
        $libelle = TextField::new('libelle','Libellé');
        $prix = MoneyField::new('prix_unit','Prix')->setCurrency('EUR');
        $devis = BooleanField::new('devis','Sous Devis');
        $dispo = BooleanField::new('disponible','Disponible');
        $slug = SlugField::new('slug')->setTargetFieldName('libelle');
        $cat = AssociationField::new('categories','Catégories');
        $sousCath = AssociationField::new('sousCategories','Sous_Catégoties');
        $description = TextEditorField::new('description','Description');

        $affichageArticle = [$panelArticles, $id, $libelle, $prix,$devis,
             $dispo,$slug, $cat,$sousCath,$description
         ];
        $panelImages = FormField::addPanel('INFOS IMAGES');
        $nomPhoto = ImageField::new('nomPhoto')
        ->setFormType(VichFileType::class)
        ->setBasePath('/images/products')
        ->hideOnForm();

        $fichierPhoto = VichImageField::new('fichierPhoto','Photo')
        ->onlyOnForms();
        $fichierPieceJointe = CollectionField::new('pieceJointes')
            ->setEntryType(PieceJointeType::class)
            ->setFormTypeOption('by_reference',false)
            ->onlyOnForms();
        $nomImageJointe = AssociationField::new('pieceJointes')
            ->setFormType(VichFileType::class)
            ->setTemplatePath('pj/image.html.twig')
            ->onlyOnDetail();


        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $affichageImages = [$panelImages,$nomPhoto,$fichierPhoto, $nomImageJointe];
        }else{
            $affichageImages = [$panelImages,$nomPhoto,$fichierPhoto,$fichierPieceJointe];
        }
        return array_merge($affichageArticle, $affichageImages);

    }
    public function configureCrud(Crud $crud): Crud{
        return parent::configureCrud($crud)
            ->setPaginatorPageSize(5)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste un article')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un article')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un article')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Infos  article');


    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
