<?php

Route::group(['namespace' => 'CVEPDB\Opcache\Clear\Http\Controllers'], function() {
	Route::delete('opcache-clear', 'OpcacheClearController@opcacheClear');
});
