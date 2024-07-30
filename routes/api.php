<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (\App\Http\Filters\Filter $filter) {
    return response()->json([
        'app' => env('APP_NAME'),
        'version' => "v0.0",
        'Build' => "Laravel v". app()->version(),
    ]);
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

Route::group(['prefix' => '/tools'], function($route) {
    $route->get('/{id}', [\App\Http\ApiControllers\ToolController::class, 'show']);
    $route->get('/', [\App\Http\ApiControllers\ToolController::class, 'index']);
    $route->post('/', [\App\Http\ApiControllers\ToolController::class, 'save']);
    $route->delete('/{id}', [\App\Http\ApiControllers\ToolController::class, 'delete']);
});
