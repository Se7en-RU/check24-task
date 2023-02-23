<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\RequestHandler;
use App\Core\Router\Router;
use Dotenv\Dotenv;


require_once __DIR__ . '/../vendor/autoload.php';

// Env variables loader
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


// DI container
$services = require_once(__DIR__ . '/../config/services.php');
$container = new Container($services);

// Router
$routes = require_once __DIR__ . '/../app/Http/routes.php';
$router = new Router($routes);

// Handle request
$requestHandler = new RequestHandler($router, $container);
$requestHandler->handle();