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


Route::middleware(['cors'])->group(function () {
    Route::get('/check-ip-config', 'AdminController@CheckIpConfig');
    Route::get('/evin-check-code', 'AdminController@CheckAccess');
});
Route::group(['prefix' => 'admin', 'middleware' => ['checkLogin','checkAdmin']], function(){
    Route::get('/', 'AdminController@getHome')->name("admin.home");
    Route::get('/list-ip', 'AdminController@listIp')->name("admin.listIp");
    Route::get('/list-user', 'AdminController@listUser')->name("admin.listUser");
    Route::post('/list-user', 'AdminController@getListUser')->name("admin.getListUser");
    Route::post('/list-products', 'AdminController@getListProducts')->name("admin.getListProducts");
    Route::post('/delete-user', 'AdminController@deleteUser')->name("admin.deleteUser");
    Route::post('/update-info-user', 'AdminController@updateInfoUser')->name("admin.updateInfoUser");
    Route::post('/list-ip', 'AdminController@getListIp')->name("admin.listIp");
    Route::post('/add-ip', 'AdminController@addIp')->name("admin.addIp");
    Route::post('/add-products', 'AdminController@addProducts')->name("admin.addProducts");
    Route::post('/update-products', 'AdminController@updateProducts')->name("admin.updateProducts");
    Route::post('/update-ip', 'AdminController@updateIp')->name("admin.updateIp");
    Route::post('/update-status-user', 'AdminController@updateStatusUser')->name("admin.updateStatusUser");
    Route::post('/delete-ip', 'AdminController@deleteIp')->name("admin.deleteIp");
    Route::post('/delete-product', 'AdminController@deleteProduct')->name("admin.deleteProduct");
    Route::get('/products', 'AdminController@products')->name("admin.products");
});
Auth::routes();
Route::get('/', 'HomeController@index')->name('getHome');
Route::get('/view-product', 'HomeController@detailProduct')->name('detailProduct');
Route::group(['prefix' => 'user', 'middleware' => ['checkLogin']], function(){
    Route::get('/profile', 'UserController@getProfile')->name("user.profile");
    Route::post('/set-ip', 'UserController@setIpAddress')->name("user.setIpAddress");
});

