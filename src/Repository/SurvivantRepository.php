<?php

namespace App\Repository;

use App\Entity\Survivant;
use App\Entity\SurvivantFilter;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Survivant>
 *
 * @method Survivant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Survivant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Survivant[]    findAll()
 * @method Survivant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurvivantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survivant::class);
    }

    public function add(Survivant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Survivant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getFilter(SurvivantFilter $search){
        $qb = $this->createQueryBuilder('su');
        $query = $qb->select('su,r,skb,sky,sko1,sko2,skr1,skr2,skr3,cl')
                    ->leftjoin('su.blueskill1','skb')
                    ->leftjoin('su.yellowskill','sky')
                    ->leftjoin('su.orangeskill1','sko1')
                    ->leftjoin('su.orangeskill2','sko2')
                    ->leftjoin('su.redskill1','skr1')
                    ->leftjoin('su.redskill2','skr2')
                    ->leftjoin('su.redskill3','skr3')
                    ->leftjoin('su.races','r')
                    ->leftjoin('su.classes','cl');

                    if($search->getRacename()!=null){
                        $query =$query  ->andWhere('r IN (:r)')
                                        ->setParameter('r',$search->getRacename());
                    }
                    if($search->getClasseName()!=null){
                        if((!$search->getClasseName()->isEmpty())){
                            $query =$query  ->andWhere('cl IN (:cl)')
                                            ->setParameter('cl',$search->getClasseName());
                        }
                    }
 
                   
        $results = $query->getQuery()->getArrayResult();
        return $results;
      
    }

    // public function findSearch(SurvivantFilter $search): array
    // {
    //     $query = $this->createQueryBuilder('s');
    //                     // ->select('c','s')

    //     if(!empty($search->racename)){
    //         $query =$query->andWhere('p.race_name LIKE :racename')
    //                         ->setParameter('racename',$search->getRacename());
    //     }

    //     return $query->getQuery()->getResult();
    // }

//    /**
//     * @return Survivant[] Returns an array of Survivant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Survivant
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
