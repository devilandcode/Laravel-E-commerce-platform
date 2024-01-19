<?php

use App\Http\Controllers\Admin\Adverts\AttributeController;
use App\Http\Controllers\Admin\Adverts\CategoryController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Account\HomeController as AccountController;
use App\Http\Controllers\Admin\HomeController as AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');

Auth::routes();
Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('register.verify');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {

        Route::get('/', [AdminController::class, 'index'])->name('home');
        Route::resource('users', UsersController::class);
        Route::resource('regions', RegionController::class);
        Route::post('users/verify', [UsersController::class, 'verify'])->name('users.verify');
        Route::group(
            [
                'prefix' => 'adverts',
                'as' => 'adverts.',
                'middleware' => ['auth'],
            ],
            function () {
                Route::resource('categories', CategoryController::class);

                Route::group(
                    [
                        'prefix' => 'categories/{category}',
                        'as' => 'categories.'
                    ],
                    function () {
                    Route::get('/first', [CategoryController::class,'first'])->name('first');
                    Route::get('/up', [CategoryController::class,'up'])->name('up');
                    Route::get('/down', [CategoryController::class,'down'])->name('down');
                    Route::get('/last', [CategoryController::class,'last'])->name('last');
                    Route::resource('attributes', AttributeController::class)->except('index');
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
    ],
    function () {
        Route::get('/', [AccountController::class, 'index'])->name('home');
    }
);


