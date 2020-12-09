<?php

namespace App\Controller;



use App\Form\RechercheType;
use App\Repository\ArticlesPrestationsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use App\Utils\Recherche;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    public function produit(Request $request): Response {

        //Recupère la liste de tout les produits d'une categories
        $produits = $this->articlesPrestationsRepository->findBy(["categories"=>4]);

        $titre_page = "Shine Esthétics";
        $titre = "Shine Esthetics Shop produit ";
        $maRecherche = new Recherche();
        $form = $this->createForm(RechercheType::class, $maRecherche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $produits = $this->articlesPrestationsRepository->findProduitByRecherche($maRecherche);

        }

        return $this->render('produit/shop/produit.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'produits'=>$produits,
           'formRecherche'=>$form->createView(),
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



}
