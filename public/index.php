<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\BaseController;
use App\Core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/users', 'users');
$app->router->post('/users', [BaseController::class, 'handle']);


$app->run();