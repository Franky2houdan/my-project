<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
        * @param $id
        * @param $categorie
        * @param $designation
        * @return Article[]
        */
    public function trouveUnArticle($id): array
    {
          $requete=$this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->orderBy('a.id', 'ASC')
            ->getQuery();
            return $requete->execute();
    }

    public function afficheListeArticle(): array
    {
        $connect = $this->getEntityManager()->getConnection();
                // automatically knows to select Products
                // the "p" is an alias you'll use in the rest of the query
                $requete = $this->createQueryBuilder('a')
                    //->orderBy('a.id', 'ASC')
                    ->getQuery();
                return $requete->execute();
                // to get just one result:
                // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }

    public function chercheUnArticle($designation,$categorie): array
    {
          $requete=$this->createQueryBuilder('a')
            ->where('a.designation = :designation')
            ->andWhere('a.categorie= :categorie')
            ->setParameter('designation', $designation)
            ->setParameter('categorie', $categorie)
            ->orderBy('a.categorie', 'ASC')
            ->getQuery();
            return $requete->execute();
    }

    public function chercheUneCategorie($categorie): array
    {
          $requete=$this->createQueryBuilder('a')
            ->where('a.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->orderBy('a.categorie', 'ASC')
            ->getQuery();
            return $requete->execute();
    }

    public function chercheUneDesignation($designation): array
    {
          $requete=$this->createQueryBuilder('a')
            ->where('a.designation = :designation')
            ->setParameter('designation', $designation)
            ->orderBy('a.designation', 'ASC')
            ->getQuery();
            return $requete->execute();
    }

}
