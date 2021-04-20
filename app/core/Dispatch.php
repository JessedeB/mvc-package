<?php

namespace App\Core;

use Exception;

class Dispatch {

    private Request $router;
    protected $params = [];
    protected $url;
    private $controller; //Assign class to property
    private $method;

    public function __construct()
    {
        $this->router = new Request();
        $this->url = array_values(array_filter(explode('/', $this->router->getPath())));
    }

    public function dispatch()
    {
        if(class_exists($this->controller)) {
            $controller = new $this->controller;

            if(method_exists($controller, $this->method)) {
                echo call_user_func($controller, $this->method);
            } else {
                echo 'Method does not exists!';
            }
        } else {
           echo 'Class does not exists!';
        }

        $this->params = $this->url ? array_values($this->url) : [];
        dump($this->params);
        return call_user_func_array([$this->controller, $this->method], $this->params);
    }
}