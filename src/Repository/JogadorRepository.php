<?php

namespace App\Repository;

use App\Entity\Jogador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class JogadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jogador::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('j')
            ->where('j.something = :value')->setParameter('value', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
