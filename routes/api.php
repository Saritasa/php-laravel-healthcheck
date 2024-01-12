<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Saritasa\LaravelHealthCheck\Http\HealthCheckApiController;

Route::prefix('health')->group(function (Router $router) {
    $router->get('', HealthCheckApiController::class.'@index');
    $router->get('{checker}', HealthCheckApiController::class.'@check');
});

Route::get('liveness', HealthCheckApiController::class.'@liveness');
Route::get('readness', HealthCheckApiController::class.'@liveness');
