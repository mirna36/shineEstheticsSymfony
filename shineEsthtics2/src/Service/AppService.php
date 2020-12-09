<?php


namespace App\Service;


use App\Repository\ArticlesPrestationsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppService
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var ArticlesPrestationsRepository
     */
    private $articlesPrestationsRepository;

    public function __construct(SessionInterface $session, ArticlesPrestationsRepository $articlesPrestationsRepository)
    {
        $this->session = $session;
        $this->articlesPrestationsRepository = $articlesPrestationsRepository;
    }

    public static function capitalize(string $mot)
    {
        return ucwords(mb_strtolower(trim($mot)));
    }

    public static function uppercase(string $mot)
    {
        return mb_strtoupper(trim($mot));
    }

    public static function concatene(string $prenom, string $nom)
    {
        return self::capitalize($prenom) . " " . self::capitalize($nom);
    }

    public static function lowercase(string $mot)
    {
        return mb_strtolower(trim($mot));
    }

    /**
     * Fonction qui permet de récupèrer le contenu du panier
     * @return array
     */
    public function contenuDuPanier(): array
    {
        $panier = $this->session->get('panier', []);
        $contenuDuPanier = [];
        foreach ($panier as $id => $quantite) {
            $produit = $this->articlesPrestationsRepository->find($id);
            $contenuDuPanier[] = [
                "quantite" => $quantite,
                "produit" => $produit
            ];
        }
        return $contenuDuPanier;
    }

    /**
     * Fonction permet d'ajouter au panier
     * @param int $id
     */

    public function ajouterAuPanier(int $id){
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);
    }

    /**
     *  Fonction qui permet de diminuer le panier
     * @param int $id
     */
    public function diminuerQteAuPanier(int $id){
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]--;
        }
        $this->session->set('panier', $panier);
    }
    /**
     *  Fonction qui permet de supprimer le produit du panier
     * @param int $id
     */
    public function supprimerDuPanier(int $id){
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);

    }
}