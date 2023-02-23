<?php

declare(strict_types=1);

use App\Core\Router\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HealthController;
use App\Http\Enum\HttpMethodEnum;

return [
    new Route(
        name: 'healthCheck',
        path: '/',
        parameters: [HealthController::class],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'articleList',
        path: '/articles',
        parameters: [ArticleController::class, 'list'],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'articleCreate',
        path: '/articles',
        parameters: [ArticleController::class, 'create'],
        method: HttpMethodEnum::POST,
    ),
    new Route(
        name: 'articleGet',
        path: '/articles/{id}',
        parameters: [ArticleController::class, 'get'],
        method: HttpMethodEnum::GET,
    ),
];