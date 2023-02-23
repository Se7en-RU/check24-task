<?php

declare(strict_types=1);

use App\Core\Container;
use App\Domain\Article\ArticleService;
use App\Domain\User\UserService;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Infrastructure\Database\DatabaseInterface;
use App\Infrastructure\Database\MysqlDatabase;
use App\Infrastructure\Repository\ArticleDatabaseRepository;
use App\Infrastructure\Repository\UserDatabaseRepository;

return [
    DatabaseInterface::class => fn() => new MysqlDatabase(
        host: $_ENV['MYSQL_HOST'],
        database: $_ENV['MYSQL_DATABASE'],
        username: $_ENV['MYSQL_USERNAME'],
        password: $_ENV['MYSQL_PASSWORD'],
    ),

    ArticleDatabaseRepository::class => fn(Container $container) =>
        new ArticleDatabaseRepository($container->get(DatabaseInterface::class)
    ),
    ArticleService::class => fn(Container $container) =>
        new ArticleService($container->get(ArticleDatabaseRepository::class)
    ),
    ArticleController::class => fn(Container $container) =>
        new ArticleController($container->get(ArticleService::class)
    ),

    UserDatabaseRepository::class => fn(Container $container) =>
    new UserDatabaseRepository($container->get(DatabaseInterface::class)
    ),
    UserService::class => fn(Container $container) =>
    new UserService($container->get(UserDatabaseRepository::class)
    ),
    UserController::class => fn(Container $container) =>
    new UserController($container->get(UserService::class)
    ),
];