<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['namespace' => 'NineCells\Til\Http\Controllers'], function() {

        Route::group(['prefix' => 'til'], function() {

            Route::get('/', 'TilPostController@GET_index');
        });
    });

    Route::group(['namespace' => 'NineCells\Til\Http\Controllers'], function() {

        Route::get('members/{member_id}/til', 'MemberController@GET_member_til_info')->name('ncells::url.til.member_til');
    });
});
