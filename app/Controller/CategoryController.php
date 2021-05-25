<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\CustomConnection;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class CategoryController extends AbstractController
{
    private EntityManager $entityManager;
    private ObjectRepository $repository;

    public function __construct()
    {
        $this->entityManager = CustomConnection::getEntityManager();
        $this->repository = $this->entityManager->getRepository(Category::class);
    }

    public function listAction(): void
    {
        $this->render('category/list', [
            'categories' => $this->repository->findAll()
        ]);

    }

    public function addAction(): void
    {
        if (!$_POST) {
            $this->render('category/add');
            return;
        }

        $category = new Category();
        $category->setName($_POST['name']);
        $category->setDescription($_POST['description']);
        $category->setImage($_POST['image']);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        self::redirectRoute('/categorias/listar');
    }

    public function editAction(): void
    {
        $category = $this->repository->find($this->repository->find($_GET['id']));

        if (!$_POST) {
            $this->render('category/edit', [
                'category' => $category
            ]);
            return;
        }

        $category->setName($_POST['name']);
        $category->setImage($_POST['image']);
        $category->setDescription($_POST['description']);

        $this->entityManager->persist($category);
        $this->entityManager->flush();
        self::redirectRoute('/categorias/listar');
    }

    public function removeAction(): void
    {
        $id = $_GET['id'];
        $category = $this->repository->find($id);

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        self::redirectRoute('/categorias/listar');
    }
}