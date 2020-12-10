<?php

namespace App\Controller;

use App\Entity\ArticlesPrestations;
use App\Service\AppService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/panier", name="panier")
     */
    public function index(AppService $appService): Response
    {
        $titre_page = "Shine Esthetics";
        $titre = "Shine Esthétics mon panier";
        $panierComplet = [];

        if($appService->get()){
            foreach ($appService->get() as $id=> $quantite){
                $panierComplet[] = [
                    'produit'=>$this->entityManager->getRepository(ArticlesPrestations::class)->findOneById($id),
                    'quantite'=>$quantite,
                ];
            }
        }


        return $this->render('panier/index.html.twig',[
            'panier'=> $panierComplet,
             'titre_page' => $titre_page,
            'titre' => $titre,
            ]
        );
    }
    /**
     * @Route("/panier/ajouter/{id}", name="ajouter")
     */
    public function ajouter(AppService $appService,$id): Response
    {
        $appService->ajouter($id);
        return $this->redirectToRoute('panier');

    }
    /**
     * @Route("/panier/diminuer/{id}", name="diminuer")
     */
    public function diminuer(AppService $appService,$id): Response
    {
        $appService->diminuer($id);
        return $this->redirectToRoute('panier');

    }
    /**
     * @Route("/panier/supprimer", name="supprimer")
     */
    public function supprimer(AppService $appService): Response
    {
        $appService->supprimer();
        return $this->redirectToRoute('shop');

    }
    /**
     * @Route("/panier/supprimerItem/{id}", name="supprimerItem")
     */
    public function supprimerItem(AppService $appService,$id): Response
    {
        $appService->supprimerItem($id);
        return $this->redirectToRoute('panier');

    }
}
