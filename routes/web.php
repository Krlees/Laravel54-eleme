<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', function() {
        return view('admin/login');
    });

    Route::get('index', 'admin\IndexController@index');
    Route::get('dashboard', function () {
        return view('admin/dashboard');
    });

    Route::group(['prefix' => 'goods'], function () {
        Route::any('index', 'admin\GoodsController@index');
        Route::any('add', 'admin\GoodsController@add');
        Route::any('edit', 'admin\GoodsController@edit');
        Route::any('del', 'admin\GoodsController@del');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::any('index', 'admin\MenuController@index');
        Route::any('add', 'admin\MenuController@add');
        Route::any('edit/{id}', 'admin\MenuController@edit');
        Route::any('del', 'admin\MenuController@del');
    });

});


//
//Route::get('/show', function () {
//    echo '<img src="' . asset('storage/1.jpg') . '" />';
//});
//
//Route::get('/image', function () {
//    // open an image file
//    $img = Image::make('public/foo.jpg');
//
//    // resize image instance
//    $img->resize(320, 240);
//
//    // insert a watermark
//    $img->insert('public/watermark.png');
//
//    // save image in desired format
//    $img->save('public/bar.jpg');
//
//});
//
//Route::get('excel', 'ExcelController@export');
//Route::get('import', 'ExcelController@import');



Auth::routes();

Route::get('/home', 'HomeController@index');
