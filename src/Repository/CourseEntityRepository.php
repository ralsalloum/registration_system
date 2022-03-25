<?php

namespace App\Repository;

use App\Entity\CourseEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CourseEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseEntity[]    findAll()
 * @method CourseEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseEntity::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CourseEntity $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CourseEntity $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    public function getAllCoursesForStudent()
//    {
//        return $this->createQueryBuilder('courseEntity')
//            ->select('courseEntity.id', 'courseEntity.name', 'courseEntity.capacity')
//
//            ->orderBy('courseEntity.id')
//            ->getQuery()
//            ->getResult();
//    }
}
