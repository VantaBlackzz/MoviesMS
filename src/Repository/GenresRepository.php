<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Genres;

/**
 * @method Genres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genres[]    findAll()
 * @method Genres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genres::class);
    }
}
