<?php

declare(strict_types=1);

use App\Core\Router\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Enum\HttpMethodEnum;

return [
    // Users
    new Route(
        name: 'userLogin',
        path: '/login',
        parameters: [UserController::class, 'loginPage'],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'userLoginForm',
        path: '/login',
        parameters: [UserController::class, 'loginForm'],
        method: HttpMethodEnum::POST,
    ),
    new Route(
        name: 'userLogout',
        path: '/logout',
        parameters: [UserController::class, 'logout'],
        method: HttpMethodEnum::GET,
    ),

    // Articles
    new Route(
        name: 'index',
        path: '/',
        parameters: [ArticleController::class, 'listPage'],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'articleList',
        path: '/page-{page}',
        parameters: [ArticleController::class, 'listPage'],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'articleCreate',
        path: '/articles/new',
        parameters: [ArticleController::class, 'createPage'],
        method: HttpMethodEnum::GET,
    ),
    new Route(
        name: 'articleCreateForm',
        path: '/articles/new',
        parameters: [ArticleController::class, 'createForm'],
        method: HttpMethodEnum::POST,
    ),
    new Route(
        name: 'articleDetail',
        path: '/articles/{id}',
        parameters: [ArticleController::class, 'detailPage'],
        method: HttpMethodEnum::GET,
    ),
];