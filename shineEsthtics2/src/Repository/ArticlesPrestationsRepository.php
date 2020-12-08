<?php

namespace App\Repository;

use App\Entity\ArticlesPrestations;
use App\Utils\Recherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticlesPrestations|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesPrestations|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesPrestations[]    findAll()
 * @method ArticlesPrestations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesPrestationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesPrestations::class);
    }

    // /**
    //  * @return ArticlesPrestations[] Returns an array of ArticlesPrestations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticlesPrestations
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param Recherche $maRecherche
     * @return array
     */
    public function findProduitByRecherche(Recherche $maRecherche): array
    {
        $maRequete = $this->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.shop', 'c');
        if ($maRecherche->getCategories()) {
            $maRequete = $maRequete
                ->andWhere('p.shop IN (:categories)')
                ->setParameter('categories', $maRecherche->getCategories());
        }
        if ($maRecherche->getChaine()) {
            $maRequete = $maRequete
                ->andWhere('p.libelle LIKE :chaine')
                ->setParameter('chaine', $maRecherche->getChaine());
        }
        return $maRequete->getQuery()->getResult();
    }
}

