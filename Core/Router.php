<?php

namespace Core;

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
            "method" => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, "GET");
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, "POST");
    }
    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, "PATCH");
    }
    public function put($uri, $controller)
    {
        $this->add($uri, $controller, "PUT");
    }
    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, "DELETE");
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method))
                return include base_path($route["controller"]);
        }

        $this->abort();
    }
}
