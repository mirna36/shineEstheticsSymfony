<?php

namespace App\Controller;



use App\Repository\ArticlesPrestationsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShineEstheticsController extends AbstractController

{

    private $sousCategoriesRepository;
    private $articlesPrestationsRepository;

    private $categoriesRepository;

    public function __construct(SousCategoriesRepository $sousCategoriesRepository,ArticlesPrestationsRepository $articlesPrestationsRepository,CategoriesRepository $categoriesRepository)
    {

        $this->sousCategoriesRepository = $sousCategoriesRepository;
        $this->articlesPrestationsRepository = $articlesPrestationsRepository;
        $this->categoriesRepository = $categoriesRepository;
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
        return $this->render('produit/shop/shop.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'sousCat'=>$this->sousCategoriesRepository->findBy(["categories"=>4]),
        ]);
    }
    /**
     * @Route("/shop/produits", name="shop_produits")
     */
    public function produit(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Shine Esthetics Shop produit ";
        return $this->render('produit/shop/produit.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'produits'=>$this->articlesPrestationsRepository->findBy(["categories"=>4]),
        ]);
    }

    /**
     * @Route("/produit/{id}--{slug}",name="detailProduit")
     * @param int $id
     * @return Response
     */
    public function detailProduit(int $id){
        $titre_page = "Shine Esthétics";
        $titre = "Shine Esthetics Shop produit ";
        return $this->render("produit/shop/detailProduit.html.twig",[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'produit'=>$this->articlesPrestationsRepository->find($id),
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
