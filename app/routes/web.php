<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('users', 'UserController');

    Route::resource('providers', 'ProviderController');

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
        Route::group(['prefix' => 'colors/{color}', 'as' => 'colors.'], function () {
            Route::post('up', 'ColorController@up')->name('up');
            Route::post('down', 'ColorController@down')->name('down');
            Route::post('first', 'ColorController@first')->name('first');
            Route::post('last', 'ColorController@last')->name('last');
        });

        Route::resource('sizes', 'SizeController');
        Route::group(['prefix' => 'sizes/{size}', 'as' => 'sizes.'], function () {
            Route::post('up', 'SizeController@up')->name('up');
            Route::post('down', 'SizeController@down')->name('down');
            Route::post('first', 'SizeController@first')->name('first');
            Route::post('last', 'SizeController@last')->name('last');
        });
    });

    Route::resource('products', 'Product\ProductController');
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::group(['prefix' => 'product'], function () {
            Route::post('set/size', 'ProductController@setSize');   
            Route::post('set/color', 'ProductController@setColor');
            Route::post('set/category', 'ProductController@setCategory');
            Route::post('update/name', 'ProductController@updateName');
        });

        Route::post('color', 'ColorController@store')->name('color.store');
        Route::post('providers/attachcategory', 'ProviderController@attach');
    });
    
    Route::group(['prefix' => 'parser', 'as' => 'parser.'], function () {
        Route::get('/', 'ParserController@index')->name('index');
        Route::get('/start', 'ParserController@start')->name('start');
    });
});