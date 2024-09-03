<?php

namespace Core;

use Core\Middleware\Middleware;

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
            "Middleware" => null,
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
        $this->routes[array_key_last($this->routes)]["Middleware"] = $key;
        return $this;
    }

    public function previousUrl()
    {
        return $_SERVER["HTTP_REFERER"];
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {
                if ($route["Middleware"]) Middleware::resolve($route["Middleware"]);

                return include base_path("Http/controllers/{$route["controller"]}");
            }
        }

        $this->abort();
    }
}
