<?php

use App\Controller\Api\CategoryApiController;
use App\Controller\CategoryController;
use App\Controller\VehicleController;

function creatRoute(string $controllerName, ?string $actionName = null): array
{
    return [
        'controller' => $controllerName,
        'action' => $actionName,
        'api_rest' => $actionName === null,
    ];
}

return [
    '/' => creatRoute(VehicleController::class, 'listAction'),
    '/veiculos/listar' => creatRoute(VehicleController::class, 'listAction'),
    '/veiculos/adicionar' => creatRoute(VehicleController::class, 'addAction'),
    '/veiculos/excluir' => creatRoute(VehicleController::class, 'removeAction'),
    '/veiculos/editar' => creatRoute(VehicleController::class, 'editAction'),

    '/categorias/listar' => creatRoute(CategoryController::class, 'listAction'),
    '/categorias/adicionar' => creatRoute(CategoryController::class, 'addAction'),
    '/categorias/excluir' => creatRoute(CategoryController::class, 'removeAction'),
    '/categorias/editar' => creatRoute(CategoryController::class, 'editAction'),

    //API
    '/api/categorias' => creatRoute(CategoryApiController::class),
    '/api/veiculos' => creatRoute(CategoryApiController::class),
];