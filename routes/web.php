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

use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;


Route::get('/', function () {
    return view('welcome');
});
Route::post('/uploads', 'UploadsController@index');
Route::get('getlist','admin\GoodsController@getList');

Route::get('add','admin\GoodsController@add');
//Route::group(['prefix' => 'admin'], function () {
//
//    Route::get('/{action}', function ($action) {
////        $class = App::make('App\\Http\\Controllers\\' . $dir . '\\' . $module . 'Controller');
////        return $class->$action();
//
//        return view("admin/" . $action);
//    });
//
//});

Route::get('/show', function () {
    echo '<img src="' . asset('storage/1.jpg') . '" />';
});

Route::get('/image', function () {
    // open an image file
    $img = Image::make('public/foo.jpg');

    // resize image instance
    $img->resize(320, 240);

    // insert a watermark
    $img->insert('public/watermark.png');

    // save image in desired format
    $img->save('public/bar.jpg');

});

Route::get('excel', 'ExcelController@export');
Route::get('import', 'ExcelController@import');


