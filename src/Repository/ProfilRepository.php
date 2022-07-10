<?php

namespace App\Repository;

use App\Entity\Profil;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Profil>
 *
 * @method Profil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profil[]    findAll()
 * @method Profil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profil::class);
    }

    public function add(Profil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Profil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // COUNT THE PROFIL BY TABLE
    public function countTable($thisplayer): array
    {
    $qb = $this->createQueryBuilder('profil');
    $query = $qb->select('count(profil.player)')
                ->leftJoin('profil.player','pl')
                ->Where('pl = :p')
                ->setParameter('p',$thisplayer);

    $results = $query->getQuery()->getSingleScalarResult();

    return [$results];
    }

    // COUNT SURVIVANT CHOOSEN BY CURRENT PLAYER
    public function countSurvivantByProfilPlayer($thisprofil): array
    {
    $qb = $this->createQueryBuilder('profil');
    $query = $qb->select('count(profil.id)')
                ->Where('profil.id = :p')
                ->setParameter('p',$thisprofil);

    $results = $query->getQuery()->getSingleScalarResult();

    return [$results];
    }

//    public function test($thisplayer): array
//    {
//     $qb = $this->createQueryBuilder('profil');
//     $query = $qb->select('profil,ta,pl')
//                 ->leftJoin('profil.tableParty','ta')
//                 ->leftJoin('profil.player','pl')
//                 ->Where('pl = :p')
//                 ->setParameter('p',$thisplayer);

//     $results = $query->getQuery()->getArrayResult();
//     return $results;


    // if($results > 0){
    //     return [null];
    // }else{
    //     return [1];
    // }
    
       
   

//    public function findOneBySomeField($value): ?Profil
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
