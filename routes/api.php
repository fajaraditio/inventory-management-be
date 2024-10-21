<?php

use App\Http\Controllers\Api\V1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::group(['prefix' => 'auth', 'name' => 'api.auth.'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::get('/user', function () {
    return auth()->user()->name;
})
    ->middleware('auth:sanctum');

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(
        function ($server) {
            $server->resource('product-categories', JsonApiController::class);
        }
    );
