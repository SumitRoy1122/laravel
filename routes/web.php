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

Route::group(
	[
		'prefix' 		=> '{locale}',
		'where' 		=> 	['locale' => '[a-zA-Z]{2}'],
		'middleware'	=>	'setLocaleMiddleware'
	], function() {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/companies', 'CompanyController@index');
		Route::get('/companies/add', function(){
			 return view("companies.create")->with(array('title'=>__('general.companyAdd')));
		})->middleware('auth');
});
Route::get('/','FirstController@index');
Auth::routes(['register' => false,'reset'=>false]);
Route::get('{lang}/change-language', 'changeLanguageController@index')->middleware('auth');
Route::post('/companies/create', 'CompanyController@create')->name('saveCompany');