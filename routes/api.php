<?php

use App\Http\Controllers\Adverts\FavoriteController;
use App\Http\Controllers\Api\Advert\AdvertController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\FavoriteController as UserFavoriteController;
use App\Http\Controllers\Api\User\AdvertController as UserAdvertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('api')
    ->prefix('auth')
    ->group(function() {

    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
//        Route::get('user', 'userProfile');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('me', 'me');
    });

    Route::prefix('user')
        ->name('user.')->group(function () {

            Route::controller(ProfileController::class)->group(function () {
                Route::get('/', 'show');
                Route::put('/', 'update');
            });

        });

});



Route::name('api.')->group(function() {
    Route::get('/', [HomeController::class, 'home']);
    Route::post('/register', [RegisterController::class, 'register']);

    Route::middleware('api')->group(function() {
        Route::resource('/adverts', AdvertController::class)
            ->only('index', 'show');

        Route::controller(FavoriteController::class)->group(function() {
            Route::post('/adverts/{advert}/favorite', 'add');
            Route::delete('/adverts/{advert}/favorite', 'remove');
        });

        Route::prefix('user')
            ->name('user.')->group(function () {

            Route::controller(ProfileController::class)->group(function() {
                Route::get('/', 'show');
                Route::put('/', 'update');
            });

            Route::controller(UserFavoriteController::class)->group(function() {
                Route::get('/favorites', 'index');
                Route::delete('/favorites/{advert}', 'remove');
            });

            Route::controller(UserAdvertController::class)->group(function() {
                Route::post('/adverts/create/{category}/{region?}', 'store');
                Route::put('/adverts/{advert}/photos', 'photos');
                Route::put('/adverts/{advert}/attributes', 'attributes');
                Route::post('/adverts/{advert}/send', 'send');
                Route::post('/adverts/{advert}/close', 'close');
            });

            Route::resource('adverts', UserAdvertController::class)
                ->only('index', 'show', 'update', 'destroy');
        });
    });
});
