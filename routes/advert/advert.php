<?php

use App\Http\Controllers\Adverts\AdvertController;
use App\Http\Controllers\Adverts\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::prefix('adverts')
    ->name('adverts.')->group(function () {

    Route::controller(AdvertController::class)->group(function() {
        Route::get('/show/{advert}',  'show')->name('show');
        Route::post('/show/{advert}/phone',  'phone')->name('phone');
        Route::get('/{adverts_path?}',  'index')->name('index')->where('adverts_path', '.+');
    });

    Route::controller(FavoriteController::class)->group(function() {
        Route::post('/show/{advert}/favorites',  'add')->name('favorites');
        Route::delete('/show/{advert}/favorites',  'remove');
    });
});
