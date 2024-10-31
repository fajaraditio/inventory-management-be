<?php

use App\Http\Controllers\Api\V1\B2BProjectController;
use App\Http\Controllers\Api\V1\B2BProjectRegionalController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ProjectReportController;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::group(['prefix' => 'auth', 'name' => 'api.auth.'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::get('b2b-project/check-similarity', [B2BProjectController::class, 'checkSimilarityAll'])->name('b2b-project.check-similarity');

    Route::group(['prefix' => '/b2b-project-regional', 'as' => 'b2b-project-regional.'], function () {
        Route::get('province',     [B2BProjectRegionalController::class, 'fetchProvince'])->name('province');
        Route::get('city',         [B2BProjectRegionalController::class, 'fetchCity'])->name('city');
        Route::get('district',     [B2BProjectRegionalController::class, 'fetchDistrict'])->name('city');
        Route::get('sub-district', [B2BProjectRegionalController::class, 'fetchSubDistrict'])->name('city');
    });

    Route::group(['prefix' => 'project-report', 'as' => 'project-report.'], function () {
        Route::get('/',         [ProjectReportController::class, 'fetch'])->name('fetch');
        Route::get('/{id}',     [ProjectReportController::class, 'fetchId'])->name('fetch-id');
        Route::post('/',        [ProjectReportController::class, 'create'])->name('create');
        Route::put('/{id}',     [ProjectReportController::class, 'update'])->name('update');
        Route::delete('/{id}',  [ProjectReportController::class, 'delete'])->name('delete');
    });
});
