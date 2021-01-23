<?php 

namespace App\IrniPanel\Router;


class Router{

    private $url;
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function get($path, $callable){
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
        return $route;
    }

    public function post($path, $callable){
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
        return $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        $file_view_path = '../views/default/errors/404.html';
        if(file_exists($file_view_path)){
            echo readfile($file_view_path);
        }else{
            echo '<b>Erreur 505 :</b> Une erreur internne est apparu le fichier "'. $file_view_path . '" n\'a pas été trouver ! <br>';
        }
    }


    public function call(){
        return call_user_func_array($this->callable, $this->matches);
    }

}