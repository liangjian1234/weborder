<?php
Route::group(['namespace'=>'Home'],function(){
    Route::match(['get','post'],'login','HomeController@login')->name('login');
    Route::get('logout','HomeController@logout')->name('logout');
    Route::match(['get','post'],'regist','HomeController@regist')->name('regist');

    Route::post('merchant','MchtController@index')->name('merchant');
    Route::get('merchant/{mchtid}','MchtController@merchant')->name('merchant.merchant');
    Route::get('combo/{package_id}','MchtController@combo')->name('merchant.combo');

    Route::get('/','HomeController@index')->name('home');

    Route::group(['prefix'=>'user'],function() {
        Route::get('/','UserController@index')->name('user');
        Route::match(['get','post'],'item_favorite','UserController@item_favorite')->name('user.favorite');
        Route::match(['get','post'],'item_cart','UserController@item_cart')->name('user.cart');

        Route::group(['middleware'=>'checktoken'],function(){
            Route::match(['get','post'],'edit','UserController@edit')->name('user.edit');
            Route::post('verify','UserController@verify')->name('user.verify');
        });
    });
});

