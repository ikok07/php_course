<?php

namespace Core;
use Core\Middleware;

use Core\Middleware\Guest;

class Router {
    protected $routes = [];

    protected function abort($status_code = 404) {
        http_response_code($status_code);
        include base_path("views/$status_code.php");
        die();
    }

    protected function add($uri, $controller, $method) {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "middleware" => null,
        ];
        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, "GET");
    }
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, "POST");
    }
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, "PATCH");
    }
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, "PUT");
    }
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, "DELETE");
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {
                if ($route["middleware"]) Middleware\Middleware::resolve($route["middleware"]);

                return include base_path($route["controller"]);
            }
        }

        $this->abort();
    }
}
