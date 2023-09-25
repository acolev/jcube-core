<?php

use Illuminate\Support\Facades\Route;

Route::controller('Api\ImagesController')->prefix('images')->group(function () {
    Route::post('/editor', 'upload')->defaults('path', 'editor');
});
