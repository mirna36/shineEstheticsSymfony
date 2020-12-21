<?php

namespace App\Controller;

use App\Form\CommandeType;
use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(AppService $appService, Request $request)
    {
        if(!$this->getUser()->getAdresses()->getValues()){
            return $this->redirectToRoute('ajouter_adresse');
        }
        $titre_page = "Shine Esthetics";
        $titre = "Shine Esthétics ma commande";
        $form = $this->createForm(CommandeType::class,null, [
            'user'=>$this->getUser()
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
        }
        return $this->render('commande/index.html.twig',[
            'titre_page' => $titre_page,
            'titre' => $titre,
            'form'=>$form->createView(),
            'panier'=>$appService->getFull()
        ]);
    }
}
