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
		Route::get('/companies', 'CompanyController@index')->middleware('auth');
		Route::get('/companies/add', function(){
			 return view("companies.create")->with(array('title'=>__('general.companyAdd')));
		})->middleware('auth');
		Route::get('/companies/edit/{companyID}', 'CompanyController@editForm')->middleware('auth');
		Route::get('/companies/delete/{companyid}', 'CompanyController@delete')->middleware('auth');
		Route::get('/employees/edit/{empid}', 'employeeController@editForm')->middleware('auth');
		Route::get('/employees/delete/{empid}', 'employeeController@delete')->middleware('auth');
		Route::get('/employees', 'employeeController@index')->middleware('auth');
		Route::get('/employees/add', function(){
			$companyList = DB::table('companies')->get();
			 return view("employees.create")->with(
			 	array(
			 		'title'=>__('general.employeesadd'),
			 		'companyList'=>$companyList)
			 );
		})->middleware('auth');
});
Route::get('/','FirstController@index')->middleware('auth');
Auth::routes(['register' => false,'reset'=>false]);
Route::get('{lang}/change-language', 'changeLanguageController@index')->middleware('auth');
Route::post('/companies/create', 'CompanyController@create')->name('saveCompany');
Route::post('/companies/update', 'CompanyController@update')->name('updateCompany');
Route::post('/employees/create', 'employeeController@create')->name('saveEmployee');
Route::post('/employees/update', 'employeeController@update')->name('updateEmployee');