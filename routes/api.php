<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Saritasa\LaravelHealthCheck\Http\HealthCheckApiController;

Route::prefix('health-check')->group(function (Router $router) {
    $router->get('', HealthCheckApiController::class.'@index');
    $router->get('{checker}', HealthCheckApiController::class.'@check');
});
