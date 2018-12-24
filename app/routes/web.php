<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('user', 'UserController');
    Route::resource('provider', 'ProviderController')->except('show');
});