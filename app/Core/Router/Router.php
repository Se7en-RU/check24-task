<?php

declare(strict_types=1);


namespace App\Core\Router;

use App\Core\Router\Exception\ResourceNotFoundException;
use ArrayIterator;

final class Router
{
    private ArrayIterator $routes;

    public function __construct(array $routes)
    {
        $this->routes = new ArrayIterator();

        foreach ($routes as $route) {
            $this->add($route);
        }
    }

    public function add(Route $route): self
    {
        $this->routes->offsetSet($route->getName(), $route);

        return $this;
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function matchFromPath(string $path, string $method): Route
    {
        foreach ($this->routes as $route) {
            if ($route->match($path, $method) === false) {
                continue;
            }

            return $route;
        }

        throw new ResourceNotFoundException('No route found');
    }
}