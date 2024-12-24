<?php


use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\Api\HomeClientController;
use App\Http\Controllers\Api\HotelDetailsController;
use App\Http\Controllers\ApiCountriesController;
use Illuminate\Support\Facades\Auth;

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

// api location
Route::get('/hotel-details/{id}', [HotelDetailsController::class, 'hotelDetails'])->name('api.hotel-details');

Route::get('/booking-details/{roomId}', [BookingController::class, 'showBookingForm'])->name('api.booking.details');
// Route::post('/{roomId}/booking-payment', [BookingController::class, 'informationPay'])->name('api.booking.payment');
// Route::post('/save-booking', [BookingController::class, 'saveBooking'])->name('api.save.booking');

Route::get('/home', [HomeClientController::class, 'home']);
Route::get('/api-countries', [ApiCountriesController::class, 'getAllCountries']);
Route::prefix('location')->group(function () {
    Route::get('provinces', [LocationController::class, 'getProvinces']);
    Route::get('districts', [LocationController::class, 'getDistricts']);
    Route::get('wards', [LocationController::class, 'getWards']);
});


