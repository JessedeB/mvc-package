<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\SiteController;
use App\Core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/users', [SiteController::class, 'users']);
$app->router->post('/users', [SiteController::class, 'handle']);

$app->run();