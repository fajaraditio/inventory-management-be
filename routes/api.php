<?php

use App\Http\Controllers\Api\V1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::group(['prefix' => 'auth', 'name' => 'api.auth.'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

// JsonApiRoute::server('v1')->prefix('v1')->resources(fn($server) => $server->resource('posts', JsonApiController::class)->readOnly());
