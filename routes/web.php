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
Route::get('/admin', function () {
    return redirect('admin/index');
});
Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware'=>['auth','auth.admin']], function () {
    Route::get('/login', function() {
        return view('admin/login');
    });

    Route::get('index', 'IndexController@index');
    Route::get('dashboard', function () {
        return view('admin/dashboard');
    });

    Route::group(['prefix' => 'goods'], function () {
        Route::any('index', 'GoodsController@index');
        Route::any('add', 'GoodsController@add');
        Route::any('edit', 'GoodsController@edit');
        Route::any('del', 'GoodsController@del');
    });

    // 权限管理
    Route::group(['prefix' => 'permission'], function () {
        Route::any('index', 'PermissionController@index');
        Route::any('add', 'PermissionController@add');
        Route::any('edit/{id}', 'PermissionController@edit');
        Route::any('del', 'PermissionController@del');
        Route::any('get-sub-perm/{id}', 'PermissionController@getSubPerm');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::any('index', 'MenuController@index');
        Route::any('add', 'MenuController@add');
        Route::any('edit/{id}', 'MenuController@edit');
        Route::any('del', 'MenuController@del');
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
