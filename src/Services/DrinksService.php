<?php

namespace App\Services;

use App\Entities\Drink;
use App\Repositories\DrinkRepository;

class DrinkService
{
    private $drinkRepository;

    public function __construct(DrinkRepository $drinkRepository)
    {
        $this->drinkRepository = $drinkRepository;
    }

    public function getAllDrinks(): array
    {
        return $this->drinkRepository->findAll();
    }

    public function createDrink(array $data): Drink
    {
        if (!$this->validateData($data)) {
            throw new \InvalidArgumentException('Invalid drink data');
        }

        $drink = new Drink();
        $drink->setName($data['name']);
        $drink->setDescription($data['description']);
        $drink->setPrice($data['price']);
        $drink->setCategory($data['category_id']); // Assuming category_id is provided

        $this->drinkRepository->save($drink);

        return $drink;
    }

    public function getDrinkById(int $id): Drink
    {
        $drink = $this->drinkRepository->find($id);

        if (!$drink) {
            throw new \Exception('Drink not found');
        }

        return $drink;
    }

    public function updateDrink(int $id, array $data): Drink
    {
        if (!$this->validateData($data)) {
            throw new \InvalidArgumentException('Invalid drink data');
        }

        $drink = $this->getDrinkById($id);

        $drink->setName($data['name']);
        $drink->setDescription($data['description']);
        $drink->setPrice($data['price']);
        $drink->setCategory($data['category_id']); // Assuming category_id is provided

        $this->drinkRepository->save($drink);

        return $drink;
    }

    public function deleteDrink(int $id): void
    {
        $drink = $this->getDrinkById($id);

        $this->drinkRepository->delete($drink);
    }

    private function validateData(array $data): bool
    {
        return isset($data['name'], $data['description'], $data['price'], $data['category_id']); // Assuming category_id is required
    }
}
