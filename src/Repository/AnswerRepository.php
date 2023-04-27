<?php

namespace App\Repository;

use App\Entity\Answer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Answer>
 *
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function save(Answer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Answer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Answer[] Returns an array of Answer objects
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

//    public function findOneBySomeField($value): ?Answer
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAnswersByAgeSlice($min, $max){
        //sql query : SELECT*FROM answer INNER JOIN submitter ON submitter.id = answer.submitter_id WHERE answer.submitter_id IN ( SELECT submitter_id FROM answer INNER JOIN question ON question.id = answer.question_id INNER JOIN survey ON survey.id = question.survey_id INNER JOIN submitter ON submitter.id = answer.submitter_id WHERE question.filter ='age' AND answer.content BETWEEN 1 AND 10);
        //sql to doctrine query builder
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
            ->innerJoin('a.submitter', 's')
            ->where('a.submitter IN (
                      SELECT s2.id
                      FROM App\Entity\Answer a2
                      INNER JOIN a2.question q
                      INNER JOIN q.survey sur
                      INNER JOIN a2.submitter s2
                      WHERE q.filter = :filter
                      AND a2.content BETWEEN :min AND :max
                   )')
            ->setParameter('filter', 'age')
            ->setParameter('min', $min)
            ->setParameter('max', $max);

        return $qb->getQuery()->getResult();
    }

    public function getSubmitterCount($min, $max){
        //sql query : SELECT COUNT(DISTINCT submitter_id) FROM answer INNER JOIN submitter ON submitter.id = answer.submitter_id WHERE answer.submitter_id IN ( SELECT submitter_id FROM answer INNER JOIN question ON question.id = answer.question_id INNER JOIN survey ON survey.id = question.survey_id INNER JOIN submitter ON submitter.id = answer.submitter_id WHERE question.filter ='age' AND answer.content BETWEEN 1 AND 10);
        //sql to doctrine query builder
        $qb = $this->createQueryBuilder('a');
        $qb->select('COUNT(DISTINCT a.submitter)')
            ->innerJoin('a.submitter', 's')
            ->where('a.submitter IN (
                      SELECT s2.id
                      FROM App\Entity\Answer a2
                      INNER JOIN a2.question q
                      INNER JOIN q.survey sur
                      INNER JOIN a2.submitter s2
                      WHERE q.filter = :filter
                      AND a2.content BETWEEN :min AND :max
                   )')
            ->setParameter('filter', 'age')
            ->setParameter('min', $min)
            ->setParameter('max', $max);

        return $qb->getQuery()->getResult();
    }

}
