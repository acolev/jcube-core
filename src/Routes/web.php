<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
	\Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::controller('SiteController')->group(function () {
	Route::get('placeholder-image/{size}/{bg?}/{color?}/{text?}', 'placeholderImage')
		->name('placeholder.image');
});

