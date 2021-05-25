<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\{
    Entity,
    Column,
    Id,
    GeneratedValue
};

/**
 * @Entity()
 */
class Vehicle
{
    /**
     * @id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private int $id;

    /**
     * @Column(nullable=true)
     */
    private string $make;

    /**
     * @Column(nullable=true)
     */
    private string $model;

    /**
     * @Column(nullable=true)
     */
    private string $year;

    /**
     * @Column(nullable=true)
     */
    private string $mileage;

    /**
     * @Column(nullable=true)
     */
    private string $plate;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getMileage(): string
    {
        return $this->mileage;
    }

    public function setMileage(string $mileage): void
    {
        $this->mileage = $mileage;
    }

    public function getPlate(): string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): void
    {
        $this->plate = $plate;
    }

}
