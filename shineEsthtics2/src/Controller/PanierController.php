<?php

namespace App\Controller;

use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/panier", name="panier_")
 */

class PanierController extends AbstractController

{
    /**
     * @var AppService
     */
    private $appService;

    public function __construct(AppService $appService){

        $this->appService = $appService;
    }

    /**
     * route qui affiche le contenu du panier
     * @Route("/", name="contenu")
     */
    public function index(): Response
    {
        $contenuDuPanier = $this->appService->contenuDuPanier();
        return $this->json(
            [
                'panier'=>$contenuDuPanier
            ]

        );
    }

    /**
     * @Route("/ajouter/{id}", name="ajouter")
     * @param int $id
     * @return RedirectResponse
     */
    public function ajouter(int $id){
        $this->appService->ajouterAuPanier($id);
        return $this->redirectToRoute('panier_contenu');

    }
}
