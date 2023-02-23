<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router\Exception\ResourceNotFoundException;
use App\Core\Router\Router;
use App\Http\Response\TemplateResponse;
use Throwable;
use Twig\Environment as Twig;

final class RequestHandler
{
    public function __construct(
        private readonly Router $router,
        private readonly Container $container,
        private readonly Twig $twig,
    ) {
    }

    public function handle(): void
    {
        try {
            // Session: user and errors
            $sessionData = [
                'user'   => $_SESSION['user'] ?? null,
                'errors' => $_SESSION['errors'] ?? null,
            ];

            $route = $this->router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

            $parameters = $route->getParameters();
            $arguments = $route->getVars();

            $controllerName = $parameters[0];
            $methodName = $parameters[1] ?? null;

            $controller = $this->container->get($controllerName);
            if (!is_callable($controller)) {
                $controller = [$controller, $methodName];
            }

            /* @var TemplateResponse $controllerResponse */
            $controllerResponse = $controller(...array_values($arguments));
            echo $this->twig->render(
                $controllerResponse->templateName,
                array_merge($controllerResponse->params, $sessionData)
            );
        } catch (ResourceNotFoundException) {
            header("HTTP/2.0 404 Not Found");
            echo $this->twig->render('/errors/404.html.twig', $sessionData);
        } catch (Throwable $e) {
            echo $this->twig->render(
                '/errors/error.html.twig',
                array_merge([
                    'error' => $e->getMessage(),
                ], $sessionData)
            );
        } finally {
            unset($_SESSION['errors']);

            exit();
        }
    }
}