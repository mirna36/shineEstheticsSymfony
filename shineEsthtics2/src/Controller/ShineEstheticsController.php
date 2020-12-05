<?php

namespace App\Controller;



use App\Repository\ArticlesPrestationsRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShineEstheticsController extends AbstractController

{

    private $sousCategoriesRepository;
    private $articlesPrestationsRepository;

    public function __construct(SousCategoriesRepository $sousCategoriesRepository,ArticlesPrestationsRepository $articlesPrestationsRepository )
    {

        $this->sousCategoriesRepository = $sousCategoriesRepository;
        $this->articlesPrestationsRepository = $articlesPrestationsRepository;
    }




    /**
     * @Route("/", name="_accueil_")
     */
    public function accueil(): Response
    {
        $titre_page = "Shine Esthetics";
        $titre = "Shine Esthétics Bienvenue!";

        return $this->render('accueil/index.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,

        ]
        );
    }
    /**
     * @Route("/shop", name="shop")
     */
    public function sousCategorie(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Shine Esthetics Shop";
        return $this->render('produit/shop.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'sousCat'=>$this->sousCategoriesRepository->findAll(),
        ]);
    }
    /**
     * @Route("/shop/produit", name="produit")
     */
    public function produit(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Shine Esthetics Shop produit ";
        return $this->render('produit/produit.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'produits'=>$this->articlesPrestationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Pas encore de compte? Enregistrez-vous!";
        return $this->render('login/register.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Contact";
        return $this->render('header_footer/contact.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
        ]);
    }
    /**
     * @Route("/panier", name="panier")
     */
    public function panier(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Validation panier";
        return $this->render('produit/panier.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
        ]);
    }
    /**
     * @Route("/devis", name="devis")
     */
    public function devis(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Demande de devis ";
        return $this->render('produit/devis.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
        ]);
    }
}
