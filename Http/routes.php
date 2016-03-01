<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['namespace' => 'NineCells\Til\Http\Controllers'], function() {

        Route::group(['prefix' => 'til'], function() {

            Route::get('/', 'TilPostController@GET_index');
            Route::get('write', 'TilPostController@GET_write_til');
            Route::post('write', 'TilPostController@POST_write_til');
            Route::get('{til_id}/edit', 'TilPostController@GET_edit_til');
            Route::put('{til_id}/update', 'TilPostController@PUT_update_til');
            Route::delete('{til_id}/delete', 'TilPostController@delete_til');
        });
    });

    Route::group(['namespace' => 'NineCells\Til\Http\Controllers'], function() {

        Route::get('members/{member_id}/til', 'MemberController@GET_member_til_info')->name('ncells::url.til.member_til');
    });
});
