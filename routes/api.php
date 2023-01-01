<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Alixame\Opportunities\Http\Controllers'], function() {
    Route::prefix('api')->group(function () {
        Route::group(['middleware' => ['api']], function () {
            Route::apiResource('opportunity','OpportunityController');

            Route::get('opportunity/status/{status}', 'OpportunityController@showByStatus');
        });
    });
});