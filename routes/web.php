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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->middleware('auth');
Route::get('/-{id}', 'HomeController@detail')->name('detail');
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/edit/{id}', 'HomeController@edit_save')->name('edit')->middleware('auth');
Route::get('/download/{id}', 'HomeController@download')->name('download');

Route::get('/-{id}/apply', 'ServerController@index')->name('apply');
Route::post('/-{id}/apply', 'ServerController@apply')->name('apply');

Route::get('/-{id}/admin/apply', 'ServerController@admin_apply')->name('admin_apply');
Route::post('/-{id}/admin/apply', 'ServerController@admin_apply_save')->name('admin_apply');

Route::get('/-{id}/donate', 'ServerController@donate')->name('donate');
Route::post('/-{id}/donate', 'ServerController@donate_save')->name('donate');

Route::get('/${id}', 'ServerController@donate_success')->name('codepay_return');
Auth::routes();
