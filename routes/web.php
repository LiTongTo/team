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

// Route::get('/', function () {
//     return view('welcome');
// });


//--------------------------------------------------------------------
Route::any('dlq','Dlucontr@dlq');
Route::any('dle','Dlucontr@dle');

Route::prefix('meeting')->middleware('login')->group(function(){
  Route::any('index','Meetingcontro@index');	
  Route::any('create','Meetingcontro@create');
  Route::any('wyi','Meetingcontro@wyi');
  Route::any('wyis','Meetingcontro@wyis');  
  Route::any('store','Meetingcontro@store');
  Route::any('edit','Meetingcontro@edit');
  Route::any('update','Meetingcontro@update');
  Route::any('updates','Meetingcontro@updates');
  Route::any('destroy','Meetingcontro@destroy');
});

//--------------------------------------------------------------------

Route::prefix('client')->group(function(){
	Route::get('create','ClientController@create');
	Route::post('store','ClientController@store');
	Route::get('index{name?}','ClientController@index');
	Route::get('destroy{id}','ClientController@destroy');
	Route::get('edit{id}','ClientController@edit');
	Route::post('update{id}','ClientController@update');
});
//--------------------------------------------------------------------
Route::prefix('/admin')->group(function(){
 Route::get('/create','AdminController@create');
 Route::post('/store','AdminController@store');
 Route::get('/checkOnly','AdminController@checkOnly');
 Route::get('/index','AdminController@index');
 Route::get('/edit/{id}','AdminController@edit');
 Route::post('/update/{id}','AdminController@update');
 Route::get('/destroy/{id}','AdminController@destroy');
});

