<?php

namespace App\Core;

use Exception;

class Dispatch {

    private Request $router;
    protected $params = [];
    private $controller; //Assign class to property
    private $method;

    public function __construct()
    {
        $this->router = new Request();
        $this->params = array_values(array_filter(explode('/', $this->router->getPath())));
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

//        empty($this->params) ? $this->controller : $this->params;

    }
}