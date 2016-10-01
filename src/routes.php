<?php 



Route::group(['middleware' => 'web'], function () {

// just for testing purposes, obsolete
Route::get('timezonesa/{timezone}', 
  'UnrulyNatives\Attitudes\AttitudesController@index');


// Docs and explanations
Route::get('attitudes-docs', 
  'UnrulyNatives\Attitudes\AttitudesController@docs');


// A working demo
Route::get('attitudes-demo', 
  'UnrulyNatives\Attitudes\AttitudesController@demo');


// A working demo
Route::get('attitudes-dashboard', 
  'UnrulyNatives\Attitudes\AttitudesController@dashboard');


// Data migration from rtconner/likeable
Route::get('attitudes-migrate-likeable', 
  'UnrulyNatives\Attitudes\AttitudesController@migrate_likeables');




/////////////////////
// ATTITUDES PACKAGE
/////////////////////



Route::any('{itemkind}/{id}/set_user_attitude', ['as' => 'attitudes.set_user_attitude', 'uses' => 'App\Http\Controllers\AttitudesController@set_user_attitude']);
Route::any('{itemkind}/{id}/set_user_importance', ['as' => 'attitudes.set_user_importance', 'uses' => 'App\Http\Controllers\AttitudesController@set_user_importance']);






});
