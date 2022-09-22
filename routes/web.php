<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/check-booking', [HomeController::class, 'checkBooking'])->name('booking.check');
Route::get('/reservation', [HomeController::class, 'booking'])->name('booking');
Route::post('/confirm-booking', [BookingsController::class, 'booking'])->name('booking.confirm');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:web']], function() {
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('dashboard');
    Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings');
    Route::get('/search_bookings', [BookingsController::class, 'search'])->name('bookings.search');
    Route::get('/bookings/{search}', [BookingsController::class, 'index'])->name('bookings.search.result');
    Route::get('/booking/{id}', [BookingsController::class, 'view'])->name('bookings.view');
    Route::get('/booking_cancel/{id}', [BookingsController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/profile', [SettingsController::class, 'profile'])->name('profile');
    Route::put('settings/profile/edit', [SettingsController::class, 'update'])->name('profile.edit');
    Route::put('settings/profile/password', [SettingsController::class, 'password'])->name('profile.password');
    Route::get('/event_center/{id}', [SettingsController::class, 'eventCenter'])->name('event_center');
    Route::post('/event_center', [SettingsController::class, 'addOrUpdateEventCenter'])->name('event_center.ops');
    Route::get('/event_center/trash/{id}', [SettingsController::class, 'trashEventCenter'])->name('event_center.trash');
});

/*Route::get('/mailable', function () {
    $booking = Booking::find(1);
 
    return new App\Mail\BookingConfirmation($booking, 'Upstairs', 'whgejf48574554');
});*/
