<?php

declare(strict_types=1);

namespace HorologyHub\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = urldecode($uri); // Decode for spaces, etc.

        // Handle subdirectories
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir));
        }
        if ($uri === '') {
            $uri = '/';
        }

        // Simple exact match for now
        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];

            if (is_array($handler)) {
                [$controller, $action] = $handler;
                $controllerInstance = new $controller();
                $controllerInstance->$action();
            } elseif (is_callable($handler)) {
                $handler();
            }
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
