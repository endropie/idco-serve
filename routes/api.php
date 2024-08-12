<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'app' => env('APP_NAME'),
        'version' => "v0.0",
        'build' => "Laravel v". app()->version(),
    ]);
});

Route::group(['prefix' => '/auth'], function($route) {
    $route->post('/login', [\App\Http\ApiControllers\AuthController::class, 'login']);
    $route->get('/user', [\App\Http\ApiControllers\AuthController::class, 'show'])->middleware(['auth:sanctum']);
});


Route::group(['prefix' => '/customers'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\CustomerController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\CustomerController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\CustomerController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\CustomerController::class, 'delete']);
});

Route::get('/fltypes', function (\App\Http\Filters\Filter $filter) {
    return \App\Http\Resources\Resource::collection(
        \App\Models\Fltype::filter($filter)->collective()
    );
});

Route::get('/rtypes', function (\App\Http\Filters\Filter $filter) {
    return \App\Http\Resources\Resource::collection(
        \App\Models\Rtype::filter($filter)->collective()
    );
});

Route::get('/r0types', function (\App\Http\Filters\Filter $filter) {
    return \App\Http\Resources\Resource::collection(
        \App\Models\R0type::filter($filter)->collective()
    );
});

Route::group(['prefix' => '/materials'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\MaterialController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\MaterialController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\MaterialController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\MaterialController::class, 'delete']);
});

Route::group(['prefix' => '/coats'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\CoatController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\CoatController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\CoatController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\CoatController::class, 'delete']);
});

Route::group(['prefix' => '/protypes'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\ProtypeController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\ProtypeController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\ProtypeController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\ProtypeController::class, 'delete']);
});

Route::group(['prefix' => '/receive-orders'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\ReceiveOrderController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\ReceiveOrderController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\ReceiveOrderController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\ReceiveOrderController::class, 'delete']);
});
