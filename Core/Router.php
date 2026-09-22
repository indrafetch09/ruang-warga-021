<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                $controller = $route['controller'];

                // 1. Array controller: [ControllerClass, 'methodName']
                if (is_array($controller)) {
                    [$class, $action] = $controller;
                    $instance = new $class();
                    return $instance->$action();
                }

                // 2. Closure / Callable
                if (is_callable($controller)) {
                    return call_user_func($controller);
                }

                // 3. String controller with '@': "HomeController@index" or "App\Controllers\HomeController@index"
                if (is_string($controller) && str_contains($controller, '@')) {
                    [$class, $action] = explode('@', $controller);
                    if (!class_exists($class)) {
                        $class = "App\\Controllers\\" . $class;
                    }
                    if (class_exists($class)) {
                        $instance = new $class();
                        return $instance->$action();
                    }
                }

                // 4. File-based controller scripts
                if (is_string($controller)) {
                    // Try Http/Controllers/ (Capital C)
                    $pathCap = base_path('Http/Controllers/' . $controller);
                    if (file_exists($pathCap)) {
                        return require $pathCap;
                    }

                    // Try Http/controllers/ (lowercase c)
                    $pathLow = base_path('Http/controllers/' . $controller);
                    if (file_exists($pathLow)) {
                        return require $pathLow;
                    }

                    // Try base_path($controller)
                    $pathBase = base_path($controller);
                    if (file_exists($pathBase)) {
                        return require $pathBase;
                    }
                }

                $this->abort(404);
            }
        }

        $this->abort(404);
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'] ?? '/';
    }

    public function abort($code = 404)
    {
        http_response_code($code);

        $viewPath = base_path("views/{$code}.php");
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "<h1>Error {$code}</h1>";
        }

        die();
    }
}
