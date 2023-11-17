<?php

namespace App\Repository;

use App\Data\SearchData;
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



/**
 * Récupère les produits en lien avec une recherche
 * @return Product[]
 */
public function findSearch(SearchData $search): array{

    // Requête pour les recherhes 
    $query = $this
    ->createQueryBuilder('p')
    ->select('c', 'p')
    ->join('p.category', 'c');


// requête pour rechercher la catégorie
if (!empty($search->categories))
{
    $query = $query
    ->andWhere('c.id IN (:categories')
    ->setParameter('categories', $search->categories);
}

    // return $this->findAll();
    return $query->getQuery()->getResult();

}

}
