<?php

namespace App\Repository;

use App\Entity\FicheArtiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
/**
 * @method FicheArtiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheArtiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheArtiste[]    findAll()
 * @method FicheArtiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheArtiste::class);
    }

    /**
     * @return FicheArtiste[]
     */

    public function findAllVisible(): array
    {
        return $this->getQueryBuilder()
        ->getQuery()
        ->getResult();
    }
    public function findLatest(): array
    {
        return $this->getQueryBuilder()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }
    private function getQueryBuilder() : QueryBuilder
    {
        return $this->createQueryBuilder('fa');
    }

    // /**
    //  * @return FicheArtiste[] Returns an array of FicheArtiste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheArtiste
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
