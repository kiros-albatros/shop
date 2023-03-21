<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllWithSearchQuery(?string $search){
        $qb = $this->createQueryBuilder('p');

        if ($search) {
            $qb
                ->andWhere('p.name LIKE :search')
                ->setParameter('search', "%$search%")
            ;
        }
        return $qb
            ;
    }

    public function findFilteredProducts(?array $filters, $category=null) {
        $qb = $this->createQueryBuilder('p');

        if(!empty($filters['title'])){
            $title = $filters['title'];
            $qb
                ->andWhere('p.name LIKE :title')
                ->setParameter('title', "%$title%")
            ;
        }

        // todo добавить связь продовца с продуктом
//        if(!empty($filters['seller'])){
//            $seller= $filters['seller'];
//            $qb
//                ->andWhere('p.seller = :seller')
//                ->setParameter('seller', "%$seller%")
//            ;
//        }

        if(!empty($filters['start'])) {
            $start = $filters['start'];
            $qb
                ->andWhere('p.price > ?1')
                ->setParameter(1, $start)

            ;
        }

        if(!empty($filters['end'])) {
            $end = $filters['end'];
            $qb
                ->andWhere('p.price < ?2')
                ->setParameter(2, $end)

            ;
        }

        //  ->setParameter('category', "%$category%")

        if ($category != null) {
            $qb
                ->andWhere('p.category = :category')
                ->setParameter('category', $category)
                ;
        }

//        if(!empty($filters['price'])) {
//            $priceArr = explode(";", $filters['price']);
//            $start = $priceArr[0];
//            $end = $priceArr[1];
//          //  dd($priceArr);
//            $qb
//            ->andWhere('p.price BETWEEN ?1 AND ?2')
//                ->setParameter(1, $start)
//                ->setParameter(2, $end)
//            ;
//        }

        return $qb;
    }

//    public function getProductSellers($id) {
//        $qb = $this->createQueryBuilder('p');
//        $qb
//        ->leftJoin('p.sellerProducts', 'sp')
//            ->addSelect('sp')
//            ->andWhere('sp.product = :id')
//            ->setParameter('id', '%'.$id.'%')
//            ->getQuery()
//            ->getResult();
//
//        return $qb;
//    }
}
