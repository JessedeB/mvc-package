<?php

namespace App\Controllers;

use App\Core\Application;

class BaseController {

    public function view($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }

}