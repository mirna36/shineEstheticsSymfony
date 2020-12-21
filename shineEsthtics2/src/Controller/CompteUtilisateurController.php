<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Form\ModifierMotDePasseType;
use App\Repository\AdresseRepository;
use App\Service\AppService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteUtilisateurController extends AbstractController
{

    private $entityManager;
    /**
     * @var AdresseRepository
     */
    private $adresseRepository;

    public function __construct(EntityManagerInterface $entityManager, AdresseRepository $adresseRepository)
    {

        $this->entityManager = $entityManager;
        $this->adresseRepository = $adresseRepository;
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function index()
    {
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte.";
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
        $titre = "Mon Compte Mode de passe.";
        $user = $this->getUser();
        $form = $this->createForm(ModifierMotDePasseType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_password = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $old_password)) {
                $new_password = $form->get('new_plainPassword')->getData();
                $password = $encoder->encodePassword($user, $new_password);
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $notification = 'Votre mot de passe a bien été mis à jour';

            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }
        return $this->render('compte_utilisateur/motDePasse.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/compte/adresse", name="adresse")
     */
    public function adresse()
    {

        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte mes adresses.";

        return $this->render('compte_utilisateur/adresse.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,

        ]);
    }

    /**
     * @Route("/compte/adresse/ajouter", name="ajouter_adresse")
     */
    public function ajouterAdresse(AppService $appService ,Request $request)
    {
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte ajouter une adresse.";
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class,$adresse);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $adresse->setUser($this->getUser());
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();
            if($appService->get()){
                return $this->redirectToRoute('commande');
            }else{
                return $this->redirectToRoute('adresse');
            }


        }

        return $this->render('compte_utilisateur/adresse_form.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route ("/compte/adresse/modifier/{id}", name="modifier_adresse")
     */

    public function modifier(Request $request,$id)
    {
        $titre_page = "Shine Esthetics";
        $titre = "Mon Compte modifier une adresse.";
        $adresse = $this->entityManager->getRepository(Adresse::class)->find($id);
        if (!$adresse || $adresse->getUser() != $this->getUser()) {
            return $this->redirectToRoute('adresse');
        }

        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('adresse');
        }
        return $this->render('compte_utilisateur/adresse_form.html.twig', [
            'titre_page' => $titre_page,
            'titre' => $titre,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/compte/adresse/supprimer/{id}", name="supprimer_adresse")
     */

    public function supprimer($id)
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->find($id);
        if ($adresse && $adresse->getUser() == $this->getUser()) {
            $this->entityManager->remove($adresse);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('adresse');

    }
}
