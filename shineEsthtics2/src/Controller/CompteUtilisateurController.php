<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteUtilisateurController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index(): Response
    {
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte!";
        return $this->render('compte_utilisateur/index.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre
        ]);
    }
    /**
     * @Route("/compte/motDePasse", name="motDePasse")
     */
    public function mdp(): Response
    {
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte Mode de passe!";
        return $this->render('compte_utilisateur/motDePasse.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre
        ]);
    }
}
