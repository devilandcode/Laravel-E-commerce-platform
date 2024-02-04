<?php


use App\Http\Controllers\Auth\NetworkController;
use App\Http\Controllers\BannerController as ClickBannerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index'])->name('home');

Auth::routes();

Route::get('/verify/{token}', [RegisterController::class, 'verify'])->name('register.verify');
Route::get('/login/phone', [LoginController::class, 'phone'])->name('login.phone');
Route::post('/login/phone', [LoginController::class, 'verify']);

Route::get('/login/{network}', [NetworkController::class, 'redirect'])->name('login.network');
Route::get('/login/{network}/callback', [NetworkController::class, 'callback']);

//Route::get('/ajax/regions', [AjaxRegionController::class, 'get'])->name('ajax.regions');

Route::get('/banner/get', [ClickBannerController::class, 'get'])->name('banner.get');
Route::get('/banner/{banner}/click', [ClickBannerController::class, 'click'])->name('banner.click');


require __DIR__ . '/advert/advert.php';
require __DIR__ . '/account/account.php';
require __DIR__ . '/admin/admin.php';
