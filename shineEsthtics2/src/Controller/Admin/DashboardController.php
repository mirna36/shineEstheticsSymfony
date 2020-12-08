<?php

namespace App\Controller\Admin;

use App\Entity\ArticlesPrestations;
use App\Entity\Categories;
use App\Entity\Shop;
use App\Entity\SousCategories;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{

     private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $users = $this->userRepository->findAll();
        return $this->render(
            'bundles/EasyAdminBundle/views/welcome.html.twig',
            [
                'nbrUsers'=>count($users)
            ]
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ShineEsthtics')
            ->setFaviconPath('images/logo.jpeg');
        

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::section('Géstion des Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::section('Géstion des produits');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Sous-Catégories', 'fas fa-list', SousCategories::class);
        yield MenuItem::linkToCrud('Articles/Prestations', 'fas fa-list', ArticlesPrestations::class);
        yield MenuItem::linkToCrud('Shop', 'fas fa-list', Shop::class);
    }

public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
{
    return parent::configureUserMenu($user)
        ->setName($this->getUser()->getNomComplet());
}


}
