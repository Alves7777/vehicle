<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\CustomConnection;
use App\Entity\Vehicle;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class VehicleController extends AbstractController
{
    private EntityManager $entityManager;
    private ObjectRepository $repository;

    public function __construct()
    {
        $this->entityManager = CustomConnection::getEntityManager();
        $this->repository = $this->entityManager->getRepository(Vehicle::class);
    }

    public function listAction(): void
    {
        $this->render('vehicle/list', [
            'vehicles' => $this->repository->findAll()
        ]);
    }

    public function addAction(): void
    {
        if (!$_POST) {
            $this->render('vehicle/add');
            return;
        }
        $vehicle = new Vehicle();
        $vehicle->setMake($_POST['make']);
        $vehicle->setMileage($_POST['mileage']);
        $vehicle->setModel($_POST['model']);
        $vehicle->setYear($_POST['year']);
        $vehicle->setPlate($_POST['plate']);

        $this->entityManager->persist($vehicle);
        $this->entityManager->flush();

        self::redirectRoute('/veiculos/listar');
    }

    public function editAction(): void
    {
        $vehicle = $this->repository->find($this->repository->find($_GET['id']));

        if (!$_POST) {
            $this->render('vehicle/edit', [
                'vehicle' => $vehicle
            ]);
            return;
        }

        $vehicle->setMake($_POST['make']);
        $vehicle->setMileage($_POST['mileage']);
        $vehicle->setModel($_POST['model']);
        $vehicle->setYear($_POST['year']);
        $vehicle->setPlate($_POST['plate']);

        $this->entityManager->persist($vehicle);
        $this->entityManager->flush();

        self::redirectRoute('/veiculos/listar');
    }

    public function removeAction(): void
    {
        $id = $_GET['id'];
        $vehicle = $this->repository->find($id);

        $this->entityManager->remove($vehicle);
        $this->entityManager->flush();

        self::redirectRoute('/veiculos/listar');
    }

}