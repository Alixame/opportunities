<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Alixame\Opportunities\Http\Controllers'], function() {
    Route::prefix('api')->group(function () {
        Route::group(['middleware' => ['api']], function () {
            Route::get('aa', function() { 
                return ['response' => 'ok'];
            });

            Route::apiResource('opportunity','OpportunityController');
        });
    });
});