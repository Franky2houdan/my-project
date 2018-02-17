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
        * @return Article[]
        */
    public function trouveUnArticle($id): array
    {
          $requete=$this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
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


}
