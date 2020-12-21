<?php


namespace App\Service;


use App\Entity\ArticlesPrestations;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppService
{
    /**
     * @var UserPasswordEncoderInterface
     * @var SessionInterface
     */
    private $session;
    private $encoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(SessionInterface $session, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager){

        $this->encoder = $encoder;
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public static function capitalize(string $mot){
        return ucwords(mb_strtolower(trim($mot)));
}
    public static function uppercase(string $mot){
        return mb_strtoupper(trim($mot));
    }
    public static function concatene(string $prenom, string $nom){
        return self::capitalize($prenom)." ".self::capitalize($nom);
    }
    public static function lowercase(string $mot){
        return mb_strtolower(trim($mot));
    }


    public function ajouter($id){
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);
    }
    public function diminuer($id){
        $panier = $this->session->get('panier',[]);

        if($panier[$id] > 1){
            $panier[$id]--;
            //retirer une quantité
        }else{
            //supprimer mon produit
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }
    public function get(){
        return $this->session->get('panier');
    }
    public function supprimer(){
        return $this->session->remove('panier');
    }
    public function supprimerItem($id){
        $panier = $this->session->get('panier',[]);
        unset($panier[$id]);
        return $this->session->set('panier', $panier);
    }

    public function getFull(){
        $panierComplet = [];

        if($this->get()){
            foreach ($this->get() as $id=> $quantite){
                $panierComplet[] = [
                    'produit'=>$this->entityManager->getRepository(ArticlesPrestations::class)->findOneById($id),
                    'quantite'=>$quantite,
                ];
            }
        }
        return $panierComplet;
    }
}