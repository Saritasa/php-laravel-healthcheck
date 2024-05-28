<?php

use Illuminate\Support\Facades\Route;
use Saritasa\LaravelHealthCheck\Http\HealthCheckApiController;

# See https://wiki.saritasa.rocks/general/rest-api-guidelines#health-check
Route::get('livez', HealthCheckApiController::class.'@liveness');
Route::get('readyz', HealthCheckApiController::class.'@liveness');
Route::get('healthz', HealthCheckApiController::class.'@index');

Route::group(['prefix' => 'health'], function ($router) {
    $router->get('', HealthCheckApiController::class.'@index');
    $router->get('{checker}', HealthCheckApiController::class.'@check');
});

// TODO: remove in version 3.x
Route::get('liveness', HealthCheckApiController::class.'@liveness');
Route::get('readness', HealthCheckApiController::class.'@liveness');
