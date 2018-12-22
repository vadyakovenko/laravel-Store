<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.', 'namespace' => 'Admin' ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});