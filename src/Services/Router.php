<?php

namespace Vita\Booking\Services;

use Vita\Booking\Controllers\ApartmentController;

class Router
{
    static private array $routes = [];

    static public function get(
        string $path,
        string $controller,
        string $function
    ): void {
        self::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'method' => 'GET',
        ];
    }

    static public function post(
        string $path,
        string $controller,
        string $function
    ): void {
        self::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'method' => 'POST',
        ];
    }

//RouterService::get('/ad/{id}', AdController::class, 'show');
    public function doRouting(?string $path, string $method, array $params): void
    {

        $id = null;

        $pathParts = explode('/', $path);
        if (isset($pathParts[2]) && is_numeric($pathParts[2])) {
            $id = (int) $pathParts[2];
            $pathParts[2] = '{id}';
        }

        $routePath = implode('/', $pathParts);

        [$controller, $function] = $this->getControllerAndFunction(
            strlen($routePath) > 1 ? rtrim($routePath, '/') : $routePath,
            $method
        );

        $c = new $controller();

        if (is_numeric($id) && !empty($params)) {
            $c->$function($id, $params);
            return;
        }

        if (!empty($params)) {
            $c->$function($params);
            return;
        }

        if (is_numeric($id)) {
            $c->$function($id);
            return;
        }

        $c->$function();
    }

    private function getControllerAndFunction(string $path, string $method): array
    {
        foreach (self::$routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                return [$route['controller'], $route['function']];
            }
        }
        return [null, null]; // Throw exception
    }
}