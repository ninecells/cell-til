<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['namespace' => 'NineCells\Til\Http\Controllers'], function() {

        Route::group(['prefix' => 'til'], function() {

            Route::get('/', 'TilPostController@GET_index');
        });
    });
});
