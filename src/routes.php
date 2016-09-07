<?php 



Route::group(['middleware' => 'web'], function () {


Route::get('timezonesa/{timezone}', 
  'UnrulyNatives\Attitudes\AttitudesController@index');

Route::get('attitudes-docs', 
  'UnrulyNatives\Attitudes\AttitudesController@docs');

Route::get('attitudes-demo', 
  'UnrulyNatives\Attitudes\AttitudesController@demo');




/////////////////////
// ATTITUDES PACKAGE
/////////////////////



Route::any('{itemkind}/{id}/set_user_attitude', ['as' => 'attitudes.set_user_attitude', 'uses' => 'AttitudesController@set_user_attitude']);
Route::any('{itemkind}/{id}/set_user_importance', ['as' => 'attitudes.set_user_importance', 'uses' => 'AttitudesController@set_user_importance']);






});
