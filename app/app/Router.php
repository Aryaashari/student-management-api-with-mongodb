<?php 

namespace Student\Management\App;

use Student\Management\Middleware;

class Router {

    public static $routes = [];
    public static function add(string $method, string $path, string $controller, string $function, array $middlewares = []) {
        self::$routes[] = [
            "method" => strtoupper($method),
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middlewares" => $middlewares
        ];
    }


    public static function run():void {

        $path = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];
        foreach(self::$routes as $route) {
            $pattern = "#^".$route["path"]."$#";

            if(preg_match($pattern, $path, $variables) && $method == $route["method"]) {
                foreach($route["middlewares"] as $middleware) {
                    $middleware = new $middleware;
                    $middleware->boot();
                }

                $function = $route["function"];
                $controller = new $route["controller"];

                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);
                 
                return;
            }
        }

        http_response_code(404);
        echo "Halaman Tidak Ditemukan";
    }

}