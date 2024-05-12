<?php

namespace App\Repositories;

use App\Entities\Drink;
use Doctrine\ORM\EntityManager;

class DrinkRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager->createQuery('SELECT d FROM App\Entities\Drink d')
            ->getResult();
    }

}