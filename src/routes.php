<?php

Route::group(['middleware' => 'web', 'namespace' => 'CVEPDB\Opcache\Clear\Http\Controllers'], function() {
	Route::get('opcache-clear', 'OpcacheClearController@opcacheClear');
});
