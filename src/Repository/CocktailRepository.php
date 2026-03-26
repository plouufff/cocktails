<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cocktail>
 */
class CocktailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cocktail::class);
    }

    public function getRandomCocktail(): Cocktail
    {
        $count = $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $random = rand(0, $count - 1);

        return $this->createQueryBuilder('c')
            ->setMaxResults(1)
            ->setFirstResult($random)
            ->getQuery()
            ->getSingleResult(AbstractQuery::HYDRATE_OBJECT);
    }

    /**
     * @return array<int, Cocktail>
     */
    public function findByIngredient(Ingredient $ingredient): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.cocktailIngredients', 'ci')
            ->andWhere('ci.ingredient = :ingredient')
            ->setParameter('ingredient', $ingredient)
            ->getQuery()
            ->getResult();
    }
}
