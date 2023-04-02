<?php

namespace App\Repository;

use App\Entity\CiteEducativeFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CiteEducativeFeedback>
 *
 * @method CiteEducativeFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method CiteEducativeFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method CiteEducativeFeedback[]    findAll()
 * @method CiteEducativeFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiteEducativeFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CiteEducativeFeedback::class);
    }

    public function save(CiteEducativeFeedback $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CiteEducativeFeedback $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CiteEducativeFeedback[] Returns an array of CiteEducativeFeedback objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CiteEducativeFeedback
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
