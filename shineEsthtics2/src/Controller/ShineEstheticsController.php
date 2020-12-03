<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShineEstheticsController extends AbstractController

{
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
     * @Route("/categories", name="categories")
     */
    public function cathegorie(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Shine + cathegories id";
        return $this->render('cathegories/categories.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
        ]);
    }
    /**
     * @Route("/categories/produit", name="produit")
     */
    public function produit(): Response {
        $titre_page = "Shine Esthétics";
        $titre = "Shine + produit id";
        return $this->render('produit/produit.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
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
