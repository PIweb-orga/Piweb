<?php

namespace App\Repository;

use App\Entity\Avis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Avis>
 *
 * @method Avis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avis[]    findAll()
 * @method Avis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avis::class);
    }

//    /**
//     * @return Avis[] Returns an array of Avis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Avis
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByDate(\DateTimeInterface $date)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.dateavis = :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

public function advancedSearchQuery($username, $restaurantName, $date)
{
    $queryBuilder = $this->createQueryBuilder('a')
        ->leftJoin('a.user', 'u')
        ->leftJoin('a.restaurant', 'r');

    if ($username !== null) {
        $queryBuilder->andWhere('u.username = :username')
            ->setParameter('username', $username);
    }

    if ($restaurantName !== null) {
        $queryBuilder->andWhere('r.nom = :restaurant_name')
            ->setParameter('restaurant_name', $restaurantName);
    }

    if ($date !== null) {
        $queryBuilder->andWhere('a.dateavis >= :date')
            ->setParameter('date', new \DateTime($date)); 
    }

    return $queryBuilder->getQuery()->getResult();
}

}
