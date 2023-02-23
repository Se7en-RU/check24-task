<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router\Exception\ResourceNotFoundException;
use App\Core\Router\Router;

final class RequestHandler
{
    public function __construct(private readonly Router $router, private readonly Container $container)
    {
    }

    public function handle(): void
    {
        try {
            $route = $this->router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

            $parameters = $route->getParameters();
            $arguments = $route->getVars();

            $controllerName = $parameters[0];
            $methodName = $parameters[1] ?? null;

            $controller = $this->container->get($controllerName);
            if (!is_callable($controller)) {
                $controller = [$controller, $methodName];
            }

            echo $controller(...array_values($arguments));
        } catch (ResourceNotFoundException) {
            header("HTTP/1.0 404 Not Found");
            echo 'Not found';
        } finally {
            exit();
        }
    }
}