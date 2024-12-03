<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/browse/{categoty:slug}', [FrontController::class, 'category'])->name('front.category');

Route::get('/details/{workshop:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/check-booking', [BookingController::class, 'checkBooking'])->name('front.check_booking');
Route::post('/check-booking/details', [BookingController::class, 'checkBookingDetails'])->name('front.check_booking_details');

Route::get('/booking/payment', [BookingController::class, 'payment'])->name('front.payment');
Route::post('/booking/payment', [BookingController::class, 'paymentStore'])->name('front.payment_store');

Route::get('/booking/{workshop:slug}', [BookingController::class, 'booking'])->name('front.booking');
Route::post('/booking/{workshop:slug}', [BookingController::class, 'bookingStore'])->name('front.booking_store');

Route::get('/booking', [BookingController::class, 'booking'])->name('booking.booking');

Route::post('/booking/finished/{bookingTransaction}', [BookingController::class, 'bookingFinished'])->name('front.booking_finished');

