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
    ): void
    {
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
    ): void
    {
        self::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'method' => 'POST',
        ];
    }

    public function doRouting(?string $path, string $method, array $params): void
    {
        $id = null;

        $pathParts = explode('/', $path);
        if (isset($pathParts[2]) && is_numeric($pathParts[2])) {
            $id = (int)$pathParts[2];
            $pathParts[2] = '{id}';
        }

        if (isset($pathParts[3]) && is_numeric($pathParts[3])) {
            $id = (int)$pathParts[3];
            $pathParts[3] = '{id}';
        }

        if (isset($pathParts[4]) && isset($pathParts[5])) {
            $startDate = $pathParts[4];
            $endDate = $pathParts[5];

            $pathParts[4] = '{startdate}';
            $pathParts[5] = '{enddate}';
        }

        $routePath = implode('/', $pathParts);

        [$controller, $function] = $this->getControllerAndFunction(
            strlen($routePath) > 1 ? rtrim($routePath, '/') : $routePath,
            $method
        );

        if ($controller === null && $function === null) {
            require(__DIR__ . '/../../view/error.php');
            die;
        }

        $controller = new $controller();

        if (is_numeric($id) && !empty($params)) {
            $controller->$function($id, $params);
            return;
        }

        if (is_numeric($id) && isset($startDate) && isset($endDate)) {
            $controller->$function($id, $startDate, $endDate);
            return;
        }

        if (!empty($params)) {
            $controller->$function($params);
            return;
        }

        if (is_numeric($id)) {
            $controller->$function($id);
            return;
        }

        $controller->$function();
    }

    private function getControllerAndFunction(string $path, string $method): int|array
    {
        foreach (self::$routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                return [$route['controller'], $route['function']];
            }
        }
        return [null, null];
    }
}
