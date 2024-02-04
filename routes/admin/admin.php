<?php

use App\Http\Controllers\Admin\Adverts\AdvertController as AdminAdvertController;
use App\Http\Controllers\Admin\Adverts\AttributeController;
use App\Http\Controllers\Admin\Adverts\CategoryController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\HomeController as AdminController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:admin-panel'])
    ->prefix('admin')
    ->name('admin.')->group(function() {

    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::resource('users', UsersController::class);
    Route::resource('regions', RegionController::class);
    Route::post('users/verify', [UsersController::class, 'verify'])->name('users.verify');


    Route::prefix('adverts')
        ->name('adverts.')->group(function () {

        Route::resource('categories', CategoryController::class);

        Route::prefix('categories/{category}')
            ->name('categories.')->group(function () {

            Route::resource('attributes', AttributeController::class)->except('index');

            Route::controller(CategoryController::class)->group(function() {

                Route::get('/first', 'first')->name('first');
                Route::get('/up', 'up')->name('up');
                Route::get('/down', 'down')->name('down');
                Route::get('/last', 'last')->name('last');
            });
        });

        Route::prefix('adverts')
            ->name('adverts.')->group(function () {

            Route::controller(AdminAdvertController::class)->group(function() {

                Route::get('/', 'index')->name('index');
                Route::get('/{advert}/edit', 'editForm')->name('edit');
                Route::put('/{advert}/edit', 'edit');
                Route::get('/{advert}/photos', 'photosForm')->name('photos');
                Route::post('/{advert}/photos', 'photos');
                Route::get('/{advert}/attributes', 'attributesForm')->name('attributes');
                Route::post('/{advert}/attributes', 'attributes');
                Route::post('/{advert}/moderate', 'moderate')->name('moderate');
                Route::get('/{advert}/reject', 'rejectForm')->name('reject');
                Route::post('/{advert}/reject', 'reject');
                Route::delete('/{advert}/destroy', 'destroy')->name('destroy');
            });

        });
    });

    Route::prefix('banners')
        ->name('banners.')->group(function () {

        Route::controller(AdminBannerController::class)->group(function() {

            Route::get('/',  'index')->name('index');
            Route::get('/{banner}/show', 'show' )->name('show');
            Route::get('/{banner}/edit', 'editForm')->name('edit');
            Route::put('/{banner}/edit',  'edit');
            Route::post('/{banner}/moderate',  'moderate')->name('moderate');
            Route::get('/{banner}/reject', 'rejectForm')->name('reject');
            Route::post('/{banner}/reject', 'reject');
            Route::post('/{banner}/pay', 'pay')->name('pay');
            Route::delete('/{banner}/destroy', 'destroy')->name('destroy');
        });
    });
});
