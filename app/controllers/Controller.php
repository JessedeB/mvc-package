<?php

namespace App\Controllers;

use App\Core\Application;

class Controller {

    public function view($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

    public function index()
    {
        echo 'Index page';
    }

}