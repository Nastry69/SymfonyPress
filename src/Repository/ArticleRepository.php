<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findLatest(int $limit = 5): array
{
    return $this->createQueryBuilder('a')
        ->orderBy('a.createdAt', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}


public function findPublishedByUserName(User $user, ?int $limit = null): array
{
    $qb = $this->createQueryBuilder('a')
        ->andWhere('a.user = :user')      // 👈 propriété Doctrine = name
        ->andWhere('a.isPublished = true')
        ->setParameter('user', $user)
        ->orderBy('a.createdAt', 'DESC');

    if ($limit !== null) {
        $qb->setMaxResults($limit);
    }

    return $qb->getQuery()->getResult();
}

public function findPublishedByUserNameString(string $name, ?int $limit = null): array
{
    $qb = $this->createQueryBuilder('a')
        ->join('a.user', 'u')                
        ->andWhere('a.isPublished = true')
        ->andWhere('u.name LIKE :name')      
        ->setParameter('name', '%' . $name . '%')
        ->orderBy('a.createdAt', 'DESC');

    if ($limit !== null) {
        $qb->setMaxResults($limit);
    }

    return $qb->getQuery()->getResult();
}


public function findAllPublished(): array
{
    return $this->createQueryBuilder('a')
        ->andWhere('a.isPublished = true')
        ->orderBy('a.createdAt', 'DESC')
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Article[] Returns an array of Article objects
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

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
