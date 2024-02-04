<?php

use App\Http\Controllers\Account\Adverts\AdvertController as MyAdvertsController;
use App\Http\Controllers\Account\Adverts\CreateController;
use App\Http\Controllers\Account\Adverts\ManageController;
use App\Http\Controllers\Account\Banners\BannerController;
use App\Http\Controllers\Account\Banners\CreateController as BannerCreateController;
use App\Http\Controllers\Account\FavoriteController as AccountFavoriteController;
use App\Http\Controllers\Account\HomeController as AccountController;
use App\Http\Controllers\Account\PhoneController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Middleware\FilledProfile;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('account')
    ->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {

        Route::controller(ProfileController::class)->group(function() {

            Route::get('/', 'index')->name('home');
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
        });

        Route::controller(PhoneController::class)->group(function() {

            Route::post('/phone', 'request')->name('phone.request');
            Route::get('/phone', 'form')->name('phone');
            Route::put('/phone', 'verify')->name('phone.verify');
            Route::post('/phone/auth', 'auth')->name('phone.auth');
        });
    });


    Route::middleware(FilledProfile::class)
        ->prefix('adverts')
        ->name('adverts.')->group(function(){
        Route::get('/', [MyAdvertsController::class, 'index'])->name('index');

        Route::controller(CreateController::class)->group(function() {

            Route::get('/create', [CreateController::class, 'category'])->name('create');
            Route::get('/create/region/{category}/{region?}', [CreateController::class, 'region'])->name('create.region');
            Route::get('/create/advert/{category}/{region?}', [CreateController::class, 'advert'])->name('create.advert');
            Route::post('/create/advert/{category}/{region?}', [CreateController::class, 'store'])->name('create.advert.store');
        });

        Route::controller(ManageController::class,)->group(function() {

            Route::get('/{advert}/edit', 'editForm')->name('edit');
            Route::put('/{advert}/edit', 'edit');
            Route::get('/{advert}/photos', 'photosForm')->name('photos');
            Route::post('/{advert}/photos', 'photos');
            Route::get('/{advert}/attributes', 'attributesForm')->name('attributes');
            Route::post('/{advert}/attributes', 'attributes');
            Route::post('/{advert}/send', 'send')->name('send');
            Route::post('/{advert}/close', 'close')->name('close');
            Route::delete('/{advert}/destroy', 'destroy')->name('destroy');
        });

    });

    Route::get('favorites', [AccountFavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('favorites/{advert}', [AccountFavoriteController::class, 'remove'])->name('favorites.remove');

    Route::middleware(FilledProfile::class)
        ->prefix('banners')
        ->name('banners.')->group(function() {


        Route::controller(BannerCreateController::class)->group(function() {

            Route::get('/create','category')->name('create');
            Route::get('/create/region/{category}/{region?}','region')->name('create.region');
            Route::get('/create/banner/{category}/{region?}','banner')->name('create.banner');
            Route::post('/create/banner/{category}/{region?}','store')->name('create.banner.store');
        });

        Route::controller(BannerController::class)->group(function() {
            base_path();
            Route::get('/','index')->name('index');
            Route::get('/show/{banner}',  'show')->name('show');
            Route::get('/{banner}/edit',  'editForm')->name('edit');
            Route::put('/{banner}/edit',  'edit');
            Route::get('/{banner}/file',  'fileForm')->name('file');
            Route::put('/{banner}/file',  'file');
            Route::post('/{banner}/send',  'send')->name('send');
            Route::post('/{banner}/cancel',  'cancel')->name('cancel');
            Route::post('/{banner}/order',  'order')->name('order');
            Route::delete('/{banner}/destroy',  'destroy')->name('destroy');
        });
    });
});
