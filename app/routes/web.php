<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('users', 'UserController');

    Route::resource('providers', 'ProviderController')->except('show');

    Route::resource('categories', 'CategoryController');
    Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
        Route::post('/first', 'CategoryController@first')->name('first');
        Route::post('/up', 'CategoryController@up')->name('up');
        Route::post('/down', 'CategoryController@down')->name('down');
        Route::post('/last', 'CategoryController@last')->name('last');
    });

    Route::resource('tags', 'TagController')->except('show');

    Route::group(['prefix' => 'characteristics', 'as' => 'characteristics.', 'namespace' => 'Characteristics'], function () {
        Route::resource('colors', 'ColorController')->except('show');
        Route::resource('sizes', 'SizeController');
    });

    Route::resource('products', 'ProductController');
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::group(['prefix' => 'product'], function () {
            Route::post('setsize', 'ProductController@setSize');   
            Route::post('setcolor', 'ProductController@setColor');
        });

        Route::post('color', 'ColorController@store')->name('color.store');
    });
    
    Route::group(['prefix' => 'parser', 'as' => 'parser.'], function () {
        Route::get('/', 'ParserController@index')->name('index');
        Route::get('/start', 'ParserController@start')->name('start');
    });
});