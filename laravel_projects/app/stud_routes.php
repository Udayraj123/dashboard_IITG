<?php
Route::get('', ['as' => 'searchStud', 'uses' => 'studSearchController@searchStud']);
Route::post('', ['as' => 'postSearchStud', 'uses' => 'studSearchController@postSearchStud']);
Route::post('getTimeTableModal', ['as' => 'getTimeTableModal', 'uses' => 'studSearchController@getTimeTableModal']);
