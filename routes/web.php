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
    return view('auth.login');
});

Route::get('/maintenance', function () {
    return view('pages-maintenance');
});

Route::get('/', 'Auth\AuthController@index')->name('loginnew');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::post('/logout', 'Auth\AuthController@logout')->name('logout');


Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', 'AdminController@index')->name('admin');
    });

    // Admin
    // Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
    Route::get('/masteripW','AdminController@masteripW')->middleware('admin')->middleware('admin');
    Route::post('/tambahipW','AdminController@tambahipW')->name('tambahipW')->middleware('admin');
    Route::get('/ip/hapus/{id}','AdminController@hapusip')->middleware('admin');
    Route::get('/deliv-report', 'AdminController@delivreport')->name('deliv-report')->middleware('admin');
    // Export to excel
    Route::post('export', 'ReportController@export')->name('export');
    
    Route::get('/masteruser','AdminController@masteruser')->middleware('admin');
    Route::post('/tambahuser','AdminController@tambahuser')->name('tambahuser')->middleware('admin');
    Route::get('/user/hapus/{id}','AdminController@hapususer')->middleware('admin');
    Route::get('/user/{id}/edit','AdminController@edit')->middleware('admin');
    Route::post('/edituser/{id}','AdminController@updateuser')->middleware('admin');
    
    // Tokopedia
    Route::get('/productTokped', 'ProductTokpedController@index')->name('productTokped')->middleware('admin');
    Route::get('/productTokped/update-wh', 'ProductTokpedController@VupdateWH')->name('update-wh')->middleware('admin');
    Route::post('/productTokped/updateStockPrice', 'ProductTokpedController@updateStokWH')->name('updateStockPrice')->middleware('admin');
    Route::post('/productSelUpdate','ProductTokpedController@productSelectedUpdate')->name('productSelUpdate');
    Route::get('/deliv-report', 'AdminController@delivreport')->name('deliv-report')->middleware('admin');
    
    
    // BLIBLI
    Route::get('/productBlibli', 'ProductBlibliController@index');
    Route::get('/productBlibli/update-wh', 'ProductBlibliController@VupdateWH')->name('update-wh-blilbli')->middleware('admin');
    Route::post('/productBlibli/updateStockPrice', 'ProductBlibliController@updateStockPrice')->name('updateStockPriceBlibli')->middleware('admin');
    Route::post('/productSelUpdateBlibli','ProductBlibliController@productSelUpdateBlibli')->name('productSelUpdateBlibli');
        
});

// Auth::routes();





// CRM
Route::get('/crm', 'CrmController@index')->name('crm')->middleware('crm');


// Admin & CRM
Route::get('/adminandcrm', 'AdminAndCrmController@index')->name('adminandcrm')->middleware('adminandcrm');

