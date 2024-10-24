<?php

use App\Http\Controllers\Api\V1\B2BProjectController;
use App\Http\Controllers\Api\V1\B2BProjectRegionalController;
use App\Http\Controllers\Api\V1\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::group(['prefix' => 'auth', 'name' => 'api.auth.'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('b2b-project/check-similarity', [B2BProjectController::class, 'checkSimilarityAll'])->name('v1.b2b-project.check-similarity');

    Route::get('b2b-project-regional/province',     [B2BProjectRegionalController::class, 'fetchProvince'])->name('v1.b2b-project-regional.province');
    Route::get('b2b-project-regional/city',         [B2BProjectRegionalController::class, 'fetchCity'])->name('v1.b2b-project-regional.city');
    Route::get('b2b-project-regional/district',     [B2BProjectRegionalController::class, 'fetchDistrict'])->name('v1.b2b-project-regional.city');
    Route::get('b2b-project-regional/sub-district', [B2BProjectRegionalController::class, 'fetchSubDistrict'])->name('v1.b2b-project-regional.city');
});

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(
        function ($server) {
            $server->resource('product-categories', JsonApiController::class);
        }
    );
