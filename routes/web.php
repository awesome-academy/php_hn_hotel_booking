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
use \App\Http\Controllers\Partner\OrderController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\CheckoutController;

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

Route::get('/', [BookingController::class, 'index'])->name('booking.index');

Route::group(['prefix' => 'customer'], function () {
    Route::get('/login', [LoginController::class, 'loginCustomer'])->name('auth.customer.loginForm');

    Route::post('/login', [LoginController::class, 'handelLoginCustomer'])->name('auth.customer.login');

    Route::get('/logOut', [LoginController::class, 'logOutCustomer'])->name('auth.customer.logout');

    Route::get('/register', [RegisterController::class, 'registerCustomer'])->name('auth.customer.registerForm');

    Route::post('/register', [RegisterController::class, 'handelRegisterCustomer'])->name('auth.customer.register');

    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['can:login.customer', 'auth'])->name('customer.profile');

    Route::get('/comment/{booking}', [ProfileController::class, 'comment'])
        ->middleware(['auth', 'can:comment,booking', 'can:login.customer'])->name('customer.reviewForm');

    Route::post('/comment/{booking}', [ProfileController::class, 'postComment'])
        ->middleware(['auth', 'can:comment,booking', 'can:login.customer'])->name('customer.review');
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
            Route::get('/', [RoomController::class, 'statisticForPartner'])->name('dashboard');

            Route::resource('rooms', RoomController::class)->only('index', 'create', 'store');

            Route::resource('hotels', PartnerController::class)->only('index', 'create', 'store');

            Route::get('orders/{order?}', [OrderController::class, 'index'])->name('order');

            Route::post('order/upload/{booking}', [PartnerController::class, 'upload'])->name('order.upload')
                ->middleware('can:order.approved,booking');

            Route::post('order/deny/{booking}', [PartnerController::class, 'deny'])->name('order.ban')
                ->middleware('can:order.approved,booking');

            Route::post('order/checkout/{booking}', [PartnerController::class, 'checkout'])->name('order.paid')
                ->middleware('can:order.checkout,booking');

            Route::get('order/detail', [OrderController::class, 'detail'])->name('order.detail');

            Route::get('notify/markAllAsRead', [OrderController::class, 'markAllAsRead'])->name('notify.markAsRead');
        });

Route::group(['prefix' => 'admin', 'middleware' => ['can:login.admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::post('upload', [AdminController::class, 'upload'])->name('admin.hotel.upload');

    Route::post('deny', [AdminController::class, 'deny'])->name('admin.hotel.ban');
});

Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('change-language');

Route::group(['prefix' => 'booking'], function () {
    Route::get('/hotel/{id}', [BookingController::class, 'detailHotel'])->name('booking.detail-hotel');

    Route::get('room/{id}', [BookingController::class, 'roomDetail'])->name('booking.detail-room');

    Route::get('/hotels', [BookingController::class, 'index'])->name('booking.index');

    Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('booking.add-to-cart');

    Route::get('/remove-room', [CartController::class, 'removeRoom'])->name('booking.remove-room');

    Route::get('/sub-room', [CartController::class, 'subRoom'])->name('booking.sub-room');

    Route::get('checkout/{hotelId}', [CheckoutController::class, 'getInfo'])->name('booking.info')
        ->middleware('auth');

    Route::post('checkout/{hotelId}', [CheckoutController::class, 'checkOut'])->name('booking.checkout');

    Route::get('hotels/search', [BookingController::class, 'search'])->name('booking.hotels.search');
});
