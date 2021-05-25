<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Adapter\CustomConnection;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;
use http\Env\Request;
use http\Env\Response;

class CategoryApiController
{
    private EntityManager $entityManager;
    private ObjectRepository $repository;

    public function __construct()
    {
        $this->entityManager = CustomConnection::getEntityManager();
        $this->repository = $this->entityManager->getRepository(Category::class);
    }

//    public function listAction(Request $request): Response
//    {
//        $category = $this->listAction($request->get('site-url'));
//        return new Response(
//            $this->serializer->serialize(
//                $category, 'json', ['gtoups' => 'category']
//            )
//        );
//    }

    public function getAction(): void
    {
        header('Content-Type: application/json');

        $data = [];

        foreach ($this->repository->findAll() as $category) {
            $data [] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'description' => $category->getDescription()
            ];
        }
        echo json_encode($data);
    }

    public function postAction(): void
    {
        $request = json_decode(
            file_get_contents('php://input'), true
        );

        $category = new Category();
        $category->setName($request['name']);
        $category->setDescription($request['description']);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $request['id'] = $category->getId();

        echo json_encode($request);

    }

    public function putAction(): void
    {
        $id = $_GET['id'];

        $request = json_decode(
            file_get_contents('php://input'), true
        );

        $category = $this->repository->find($id);
        $category->setName($request['name']);
        $category->setDescription($request['description']);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        echo json_encode($request);
    }

    public function deleteAction(): void
    {
        $id = $_GET['id'];

        $category = $this->repository->find($id);

        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

}