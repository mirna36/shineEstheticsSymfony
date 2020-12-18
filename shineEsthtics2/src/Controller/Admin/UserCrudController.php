<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCrudController extends AbstractCrudController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder = $encoder;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud{
        return parent::configureCrud($crud)
            ->setPaginatorPageSize(5)
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Utilisateurs')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un Utilisateur')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un Utilisateur')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Infos  Utilisateur');

        
    }


    public function configureFields(string $pageName): iterable
    {
        $panelUtilisateurs = FormField::addPanel('INFOS Utilisateur');
        $id = IdField::new('id', 'ID')->onlyOnIndex();
        $nom = TextField::new('nom','Nom');
        $prenom = TextField::new('prenom','Prénom');
        $telephone = TelephoneField::new('telephone','Télèphone');
        $cathegories = ArrayField::new('roles','Cathégorie');
        $email = EmailField::new('email', 'Email');
        $password = TextField::new('password','Password')->onlyWhenCreating();

        $dateCreation = DateField::new('created_at','Date de Creation')->onlyOnIndex();

        $affichageUtilisateur = [$panelUtilisateurs, $id, $nom, $prenom,$telephone,$cathegories,
            $email,$password, $dateCreation
        ];

        return array_merge($affichageUtilisateur);

    }


}
