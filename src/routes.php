<?php 

Route::get('timezonesa/{timezone}', 
  'UnrulyNatives\Attitudes\AttitudesController@index');

Route::get('attitudes-docs', 
  'UnrulyNatives\Attitudes\AttitudesController@docs');