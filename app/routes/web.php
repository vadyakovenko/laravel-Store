<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');
