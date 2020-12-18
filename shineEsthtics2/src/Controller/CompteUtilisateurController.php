<?php

namespace App\Controller;

use App\Form\ModifierMotDePasseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteUtilisateurController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte", name="compte")
     */
    public function index()
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
    public function mdp(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $notification = null;
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte Mode de passe!";
        $user = $this->getUser();
        $form = $this->createForm(ModifierMotDePasseType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $old_password = $form->get('old_password')->getData();
            if($encoder->isPasswordValid($user, $old_password)){
                $new_password = $form->get('new_plainPassword')->getData();
                $password = $encoder->encodePassword($user, $new_password);
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $notification ='Votre mot de passe a bien été mis à jour';

            }else{
                $notification ="Votre mot de passe actuel n'est pas le bon";
            }
        }
        return $this->render('compte_utilisateur/motDePasse.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,
            'form' => $form->createView(),
            'notification' =>$notification,
        ]);
    }
}
