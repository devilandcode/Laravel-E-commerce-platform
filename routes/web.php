<?php

use App\Http\Controllers\Account\Adverts\CreateController;
use App\Http\Controllers\Account\Adverts\ManageController;
use App\Http\Controllers\Account\Banners\BannerController;
use App\Http\Controllers\Adverts\AdvertController;
use App\Http\Controllers\Adverts\FavoriteController;
use App\Http\Controllers\Ajax\RegionController as AjaxRegionController;
use App\Http\Controllers\Account\Adverts\AdvertController as MyAdvertsController;
use App\Http\Controllers\Admin\Adverts\AdvertController as AdminAdvertController;
use App\Http\Controllers\Accoount\Banners\CreateController as BannerCreateController;
use App\Http\Controllers\Account\PhoneController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Admin\Adverts\AttributeController;
use App\Http\Controllers\Admin\Adverts\CategoryController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Account\HomeController as AccountController;
use App\Http\Controllers\Admin\HomeController as AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index'])->name('home');

Auth::routes();

Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('register.verify');
Route::get('/login/phone', [LoginController::class, 'phone'])->name('login.phone');
Route::post('/login/phone', [LoginController::class, 'verify']);

//Route::get('/ajax/regions', [AjaxRegionController::class, 'get'])->name('ajax.regions');

Route::group([
    'prefix' => 'adverts',
    'as' => 'adverts.',
], function () {
    Route::get('/show/{advert}', [AdvertController::class, 'show'])->name('show');
    Route::post('/show/{advert}/phone', [AdvertController::class, 'phone'])->name('phone');
    Route::post('/show/{advert}/favorites', [FavoriteController::class, 'add'])->name('favorites');
    Route::delete('/show/{advert}/favorites', [FavoriteController::class, 'remove']);


    Route::get('/{adverts_path?}', [AdvertController::class, 'index'])->name('index')->where('adverts_path', '.+');
});

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'can:admin-panel'],
    ], function () {
        Route::get('/', [AdminController::class, 'index'])->name('home');
        Route::resource('users', UsersController::class);
        Route::resource('regions', RegionController::class);
        Route::post('users/verify', [UsersController::class, 'verify'])->name('users.verify');


        Route::group(
            [
                'prefix' => 'adverts',
                'as' => 'adverts.',
                'middleware' => ['auth'],
            ], function () {
                Route::resource('categories', CategoryController::class);

            Route::group(
                [
                    'prefix' => 'categories/{category}',
                    'as' => 'categories.'
                ], function () {
                Route::get('/first', [CategoryController::class,'first'])->name('first');
                Route::get('/up', [CategoryController::class,'up'])->name('up');
                Route::get('/down', [CategoryController::class,'down'])->name('down');
                Route::get('/last', [CategoryController::class,'last'])->name('last');
                Route::resource('attributes', AttributeController::class)->except('index');
            });

            Route::group(
                [
                    'prefix' => 'adverts',
                    'as' => 'adverts.'
                ], function () {
                Route::get('/', [AdminAdvertController::class, 'index'])->name('index');
                Route::get('/{advert}/edit', [AdminAdvertController::class, 'editForm'])->name('edit');
                Route::put('/{advert}/edit', [AdminAdvertController::class, 'edit']);
                Route::get('/{advert}/photos', [AdminAdvertController::class, 'photosForm'])->name('photos');
                Route::post('/{advert}/photos', [AdminAdvertController::class, 'photos']);
                Route::get('/{advert}/attributes', [AdminAdvertController::class, 'attributesForm'])->name('attributes');
                Route::post('/{advert}/attributes', [AdminAdvertController::class, 'attributes']);
                Route::post('/{advert}/moderate', [AdminAdvertController::class, 'moderate'])->name('moderate');
                Route::get('/{advert}/reject', [AdminAdvertController::class, 'rejectForm'])->name('reject');
                Route::post('/{advert}/reject', [AdminAdvertController::class, 'reject']);
                Route::delete('/{advert}/destroy', [AdminAdvertController::class, 'destroy'])->name('destroy');
            });
            }
        );
    }
);

Route::group(
    [
        'prefix' => 'account',
        'as' => 'account.',
        'middleware' => ['auth'],

    ], function () {
        Route::get('/', [AccountController::class, 'index'])->name('home');

        Route::group(
            [
                'prefix' => 'profile',
                'as' => 'profile.'
            ], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('home');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/update', [ProfileController::class, 'update'])->name('update');
            Route::post('/phone', [PhoneController::class, 'request'])->name('phone.request');
            Route::get('/phone', [PhoneController::class, 'form'])->name('phone');
            Route::put('/phone', [PhoneController::class, 'verify'])->name('phone.verify');

            Route::post('/phone/auth', [PhoneController::class, 'auth'])->name('phone.auth');
        });


        Route::group(
            [
                'prefix' => 'adverts',
                'as' => 'adverts.',
            ], function () {
            Route::get('/', [MyAdvertsController::class, 'index'])->name('index');
            Route::get('/create', [CreateController::class, 'category'])->name('create');
            Route::get('/create/region/{category}/{region?}', [CreateController::class, 'region'])->name('create.region');
            Route::get('/create/advert/{category}/{region?}', [CreateController::class, 'advert'])->name('create.advert');
            Route::post('/create/advert/{category}/{region?}', [CreateController::class, 'store'])->name('create.advert.store');

            Route::get('/{advert}/edit', [ManageController::class,'editForm'])->name('edit');
            Route::put('/{advert}/edit', [ManageController::class,'edit']);
            Route::get('/{advert}/photos', [ManageController::class,'photosForm'])->name('photos');
            Route::post('/{advert}/photos', [ManageController::class,'photos']);
            Route::get('/{advert}/attributes', [ManageController::class,'attributesForm'])->name('attributes');
            Route::post('/{advert}/attributes', [ManageController::class,'attributes']);
            Route::post('/{advert}/send', [ManageController::class,'send'])->name('send');
            Route::post('/{advert}/close', [ManageController::class,'close'])->name('close');
            Route::delete('/{advert}/destroy', [ManageController::class,'destroy'])->name('destroy');
        });

        Route::group([
            'prefix' => 'banners',
            'as' => 'banners.',
            'middleware' => [App\Http\Middleware\FilledProfile::class],
        ], function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerCreateController::class, 'category'])->name('create');
            Route::get('/create/region/{category}/{region?}',[BannerCreateController::class, 'region'])->name('create.region');
            Route::get('/create/banner/{category}/{region?}',[BannerCreateController::class, 'banner'])->name('create.banner');
            Route::post('/create/banner/{category}/{region?}',[BannerCreateController::class, 'store'])->name('create.banner.store');

            Route::get('/show/{banner}', [BannerController::class, 'show'])->name('show');
            Route::get('/{banner}/edit', [BannerController::class, 'editForm'])->name('edit');
            Route::put('/{banner}/edit', [BannerController::class, 'edit']);
            Route::get('/{banner}/file', [BannerController::class, 'fileForm'])->name('file');
            Route::put('/{banner}/file', [BannerController::class, 'file']);
            Route::post('/{banner}/send', [BannerController::class, 'send'])->name('send');
            Route::post('/{banner}/cancel', [BannerController::class, 'cancel'])->name('cancel');
            Route::post('/{banner}/order', [BannerController::class, 'order'])->name('order');
            Route::delete('/{banner}/destroy', [BannerController::class, 'destroy'])->name('destroy');
        });

    }
);


