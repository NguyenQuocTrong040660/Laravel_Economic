<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});

/*khi lick home thi tra v views/home*/
Route::get('/home', function () {
    return view('home');
});

//LOGIN_ADMIN
 Route::prefix('Login')->group(function (){
     Route::post('/','App\Http\Controllers\AdminController@login')->name('admin.login');

 });

//ADMIN_>MENU or CATEGOGY
Route::prefix('admin')->group(function (){
    Route::get('/', function () {
        return view('login');
    });
    Route::prefix('categories')->group(function () {


        //khi nguoi dung click vao danh muc san pham "partial.slider"
        Route::get('/','App\Http\Controllers\categorycontroller@index')->name('category.index');

        //index cua category , click vao add(category.create) to categorycontrolle goi ham 'create()'
        Route::get('/create', 'App\Http\Controllers\categorycontroller@create')->name('category.create');
        // form them danh muc san pham
        Route::POST('/store','App\Http\Controllers\categorycontroller@store')->name('category.store');

        //imdex : edit danh muc sp
        Route::get('/edit/{id}','App\Http\Controllers\categorycontroller@edit')->name('category.edit');

        //index : delete dmsp
        Route::get('/delete/{id}','App\Http\Controllers\categorycontroller@delete')->name('category.delete');

        // edit->form post action:update
        Route::post('/update/{id}','App\Http\Controllers\categorycontroller@update')->name('category.update');

    });
    Route::prefix('menu')->group(function () {


        //khi nguoi dung click vao danh muc san pham "partial.slider"
        Route::get('/','App\Http\Controllers\menuController@index')->name('menu.index');
        Route::get('/Add','App\Http\Controllers\menuController@Add')->name('menu.add');
        Route::POST('/store','App\Http\Controllers\menuController@store')->name('menu.store');

        //khi nguoi dung menu->edit
        Route::get('/edit/{id}','App\Http\Controllers\menuController@edit')->name('menu.edit');
        Route::POST('/update/{id}','App\Http\Controllers\menuController@update')->name('menu.update');
        Route::get('/delete/{id}','App\Http\Controllers\menuController@delete')->name('menu.delete');

    });
    Route::prefix('product')->group(function (){
        Route::get('/','App\Http\Controllers\ProductController@index')->name('product.index');
        Route::get('/add','App\Http\Controllers\ProductController@add')->name('product.add');
        Route::post('/store','App\Http\Controllers\ProductController@store')->name('product.store');

    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
