<?php

namespace App\Controller;

use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(AppService $appService): Response
    {
        dd($appService->get());
        return $this->render('panier/index.html.twig'
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
     * @Route("/panier/supprimer", name="supprimer")
     */
    public function supprimer(AppService $appService): Response
    {
        $appService->supprimer();
        return $this->redirectToRoute('shop');

    }
}
