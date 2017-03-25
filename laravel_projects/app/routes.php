	<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('stationary/{view}/{currH?}',['as'=>'stationary_view','uses'=>'stationaryController@fetchMenu']);

Route::group(['prefix'=>'student_search'],function(){
	include('stud_routes.php');
});


Route::get('/',['as'=>'vendorlogin','uses'=>'vendorController@login']);
Route::get('/login',['as'=>'vendorlogin1','uses'=>'vendorController@login']);
Route::group(['before'=>'csrf'],function(){
	//cause I used Form::open()
	Route::post('/login',['as'=>'postvendorlogin','uses'=>'vendorController@postlogin']);
});

//ajax - out of auth for test
Route::post('/fetchProds',['as'=>'fetchProds','uses'=>'vendorController@fetchProds']);
Route::post('/addProd',['as'=>'addProd','uses'=>'vendorController@addProd']);
Route::post('/delProd',['as'=>'delProd','uses'=>'vendorController@delProd']);

Route::group(['before'=>'auth.vendor'],function(){
});
////////////////////////////////////////////*************** Olds *******************///////////////////////////////////////
