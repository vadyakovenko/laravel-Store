<?php

Route::get('/', "HomeController@index")->name('home');
Auth::routes();
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('users', 'UserController');
    
    Route::group(['namespace' => 'Provider'], function () {
        Route::resource('providers', 'ProviderController');
        Route::group(['prefix' => '/providers/{provider}/', 'as' => 'providers.'], function () {
            Route::resource('import', 'ImportSettingsController')->except(['index']);
        });
    });

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
    Route::delete('products/provider/delete', 'Product\ProductController@deleteByProvider')->name('products.provider.delete');
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::group(['prefix' => 'product'], function () {
            Route::post('set/size', 'ProductController@setSize');   
            Route::post('set/color', 'ProductController@setColor');
            Route::post('set/category', 'ProductController@setCategory');
            Route::post('update/name', 'ProductController@updateName');
            Route::post('update/price', 'ProductController@updatePrice');
            Route::post('update/description', 'ProductController@updateDescription');
        });

        Route::post('color', 'ColorController@store')->name('color.store');
        Route::post('providers/attachcategory', 'ProviderController@attach');
    });
    
    Route::group(['prefix' => 'imports', 'as' => 'imports.'], function () {
        Route::get('/', 'ImportController@index')->name('index');
        Route::post('/start/{provider}', 'ImportController@start')->name('start');
    });
});