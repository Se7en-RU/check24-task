<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\RequestHandler;
use App\Core\Router\Router;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


require_once __DIR__ . '/../vendor/autoload.php';

// Env variables loader
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

session_start();

// DI container
$services = require_once(__DIR__ . '/../config/services.php');
$container = new Container($services);

// Router
$routes = require_once __DIR__ . '/../app/Http/routes.php';
$router = new Router($routes);

// Template engine Twig
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

// Handle request
$requestHandler = new RequestHandler($router, $container, $twig);
$requestHandler->handle();