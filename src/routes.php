<?php

Route::group(['middleware' => 'web', 'namespace' => 'ABENEVAUT\Opcache\Clear\Http\Controllers'], function() {
	Route::get('opcache-clear', 'OpcacheClearController@opcacheClear');
});
