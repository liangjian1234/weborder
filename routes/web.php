<?php
Route::group(['namespace'=>'Home'],function(){
    Route::match(['get','post'],'login','HomeController@login')->name('login');
    Route::get('logout','HomeController@logout')->name('logout');
    Route::match(['get','post'],'regist','HomeController@regist')->name('regist');
    Route::get('/','HomeController@index')->name('home');

    Route::group(['prefix'=>'user'],function() {
        Route::get('/','UserController@index')->name('user');

        Route::group(['middleware'=>'checktoken'],function(){
            Route::match(['get','post'],'edit','UserController@edit')->name('user.edit');
            Route::post('verify','UserController@verify')->name('user.verify');
        });
    });
    Route::group(['prefix'=>'mcht'],function (){
        Route::get('/{mcht}','MchtController@index')->name('mcht');
    });
});

