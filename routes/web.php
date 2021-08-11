<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Auth\RegisterController;
use \App\Http\Controllers\PartnerController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\Partner\RoomController;
use \App\Http\Controllers\LanguageController;
use \App\Http\Controllers\BookingController;
use \App\Http\Controllers\Customer\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/login', [LoginController::class, 'loginCustomer'])->name('auth.customer.loginForm');

    Route::post('/login', [LoginController::class, 'handelLoginCustomer'])->name('auth.customer.login');

    Route::get('/logOut', [LoginController::class, 'logOutCustomer'])->name('auth.customer.logout');

    Route::get('/register', [RegisterController::class, 'registerCustomer'])->name('auth.customer.registerForm');

    Route::post('/register', [RegisterController::class, 'handelRegisterCustomer'])->name('auth.customer.register');

    Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('customer.profile');

    Route::get('/comment/{booking}', [ProfileController::class, 'comment'])
        ->middleware(['auth', 'can:comment,booking'])->name('customer.reviewForm');

    Route::post('/comment/{id}', [ProfileController::class, 'postComment'])
        ->middleware(['auth', 'can:comment,booking'])->name('customer.review');
});


Route::group(['prefix' => 'cms'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('auth.loginForm');

    Route::post('/login', [LoginController::class, 'handelLogin'])->name('auth.login');

    Route::get('/logOut', [LoginController::class, 'logOut'])->name('auth.logout');

    Route::get('/register', [RegisterController::class, 'register'])->name('auth.registerForm');

    Route::post('/register', [RegisterController::class, 'handelRegister'])->name('auth.register');
});

Route::group(['prefix' => 'partners', 'as' => 'partners.',
        'middleware' => ['can:login.partner']], function () {
            Route::resource('rooms', RoomController::class)->only('index', 'create', 'store');

            Route::resource('hotels', PartnerController::class)->only('index', 'create', 'store');
        });

Route::group(['prefix' => 'admin', 'middleware' => ['can:login.admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::post('upload', [AdminController::class, 'upload'])->name('admin.hotel.upload');

    Route::post('deny', [AdminController::class, 'deny'])->name('admin.hotel.ban');
});

Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('change-language');

Route::group(['prefix' => 'booking'], function () {
    Route::get('/hotels', [BookingController::class, 'index']);

    Route::get('/hotel/{id}', [BookingController::class, 'detailHotel']);
    
    Route::get('room/{id}', [BookingController::class, 'roomDetail']);
});
