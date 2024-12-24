<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\HotelDetailsController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\ConvenientController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeClientController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDeviceController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\client\BookingController;
use App\Http\Controllers\ApiLoacationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ManageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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





// Dashboard routes
Route::prefix('admin')->name('admin.')->middleware(['checkRoleAdmin', 'checkLogin'])->group(function () {
    Route::get('/', [AnalyticsController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [AdminNotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');
    // Route để lấy danh sách thông báo
    Route::get('/get-notifications', [AdminNotificationController::class, 'getNotifications']);

    Route::middleware(['checkAdmin'])->group(function () {
        // User management routes
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/{id}/status', [UserController::class, 'updateStatus'])->name('updateStatus');
        });

        // Categories routes
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::middleware('checkCategory')->group(function () {
                Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [CategoryController::class, 'detail'])->name('detail');
            });

            Route::get('/trash', [CategoryController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [CategoryController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
        });

        // Locations routes
        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('index');
            Route::get('/create', [LocationController::class, 'create'])->name('create');
            Route::post('/store', [LocationController::class, 'store'])->name('store');
            Route::middleware('checkLocation')->group(function () {
                Route::get('/edit/{id}', [LocationController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [LocationController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [LocationController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [LocationController::class, 'detail'])->name('detail');
            });
            Route::get('/trash', [LocationController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [LocationController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [LocationController::class, 'forceDelete'])->name('forceDelete');
        });

        // Characteristic routes
        Route::prefix('characteristics')->name('characteristics.')->group(function () {
            Route::get('/', [CharacteristicController::class, 'index'])->name('index');
            Route::get('/create', [CharacteristicController::class, 'create'])->name('create');
            Route::post('/store', [CharacteristicController::class, 'store'])->name('store');
            // Bảo vệ các route cần kiểm tra location bằng middleware 'checkLocation'
            Route::middleware('checkCharacteristic')->group(function () {
                Route::get('/edit/{id}', [CharacteristicController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [CharacteristicController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [CharacteristicController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [CharacteristicController::class, 'detail'])->name('detail');
            });
            Route::get('/trash', [CharacteristicController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [CharacteristicController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [CharacteristicController::class, 'forceDelete'])->name('forceDelete');
        });

        // Banners routes
        Route::prefix('banners')->name('banners.')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/store', [BannerController::class, 'store'])->name('store');
            Route::middleware('checkBanner')->group(function () {
                Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [BannerController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [BannerController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [BannerController::class, 'detail'])->name('detail');
            });
            Route::get('/trash', [BannerController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [BannerController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [BannerController::class, 'forceDelete'])->name('forceDelete');
        });

        // User device routes
        Route::prefix('userDevice')->name('userDevice.')->group(function () {
            Route::get('/', [UserDeviceController::class, 'index'])->name('index');
        });

        // Convenient routes
        Route::prefix('convenients')->name('convenients.')->group(function () {
            Route::get('/', [ConvenientController::class, 'index'])->name('index');
            Route::get('/create', [ConvenientController::class, 'create'])->name('create');
            Route::post('/store', [ConvenientController::class, 'store'])->name('store');
            // Bảo vệ các route cần kiểm tra location bằng middleware 'checkLocation'
            Route::middleware('checkConvenient')->group(function () {
                Route::get('/edit/{id}', [ConvenientController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [ConvenientController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [ConvenientController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [ConvenientController::class, 'detail'])->name('detail');
            });
            Route::get('/trash', [ConvenientController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [ConvenientController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [ConvenientController::class, 'forceDelete'])->name('forceDelete');
        });
    });

    Route::middleware(['checkUserAdmin'])->group(function () {
        //management route
        Route::prefix('manage')->name('manage.')->group(function () {
            Route::get('/manageBooking', [ManageController::class, 'manageBooking'])->name('manageBooking');
            Route::get('/manageRoom', [ManageController::class, 'manageRoom'])->name('manageRoom');
            Route::get('/detail-order/{id}', [ManageController::class, 'detailOrder'])->name('detailOrder');
            Route::get('/detail-room/{id}', [ManageController::class, 'detailRoom'])->name('detailRoom');
            Route::post('/updateStatus/{id}', [ManageController::class, 'updateStatus'])->name('updateStatus');
            Route::post('/addNameRoom/{id}', [ManageController::class, 'addNameRoom'])->name('addNameRoom');
        });

        // destination
        Route::prefix('destinations')->name('destinations.')->group(function () {
            Route::get('/', [DestinationController::class, 'index'])->name('index');
            Route::get('/create', [DestinationController::class, 'create'])->name('create');
            Route::post('/store', [DestinationController::class, 'store'])->name('store');

            // Group với middleware checkDestination cho các route yêu cầu ID
            Route::middleware('checkDestination')->group(function () {
                Route::get('/edit/{id}', [DestinationController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [DestinationController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [DestinationController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [DestinationController::class, 'detail'])->name('detail');
            });
            Route::get('/trash', [DestinationController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [DestinationController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [DestinationController::class, 'forceDelete'])->name('forceDelete');
        });

        // Variants routes
        Route::prefix('variants')->name('variants.')->group(function () {
            Route::get('/', [VariantController::class, 'index'])->name('index');
            Route::get('/create', [VariantController::class, 'create'])->name('create');
            Route::post('/store', [VariantController::class, 'store'])->name('store');
            Route::middleware('checkVariant')->group(function () {
                Route::get('/{id}/edit', [VariantController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [VariantController::class, 'update'])->name('update');
                Route::get('/detail/{id}', [VariantController::class, 'detail'])->name('detail');
                Route::delete('/delete/{id}', [VariantController::class, 'destroy'])->name('delete');
            });
            Route::get('/trash', [VariantController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [VariantController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [VariantController::class, 'forceDelete'])->name('forceDelete');
        });

        // Rooms routes
        Route::prefix('rooms')->name('rooms.')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('index');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::post('/store', [RoomController::class, 'store'])->name('store');
            Route::middleware('checkRoom')->group(function () {
                Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [RoomController::class, 'update'])->name('update');
                Route::get('/detail/{id}', [RoomController::class, 'detail'])->name('detail');
                Route::delete('/delete/{id}', [RoomController::class, 'destroy'])->name('delete');
            });
            Route::get('/trash', [RoomController::class, 'getTrash'])->name('trash');
            Route::post('/restore/{id}', [RoomController::class, 'restoreTrash'])->name('restore');
            Route::get('/forceDelete/{id}', [RoomController::class, 'forceDelete'])->name('forceDelete');
        });

        // Route Admin Promotion
        Route::controller(PromotionController::class)
            ->name('promotion.')
            ->prefix('promotion')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{id}/show', 'show')->name('show');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::post('/{id}/update', 'update')->name('update');
                Route::post('/{id}/destroy', 'destroy')->name('destroy');
                Route::get('/trash', 'trash')->name('trash');
                Route::post('/restore/{id}', 'restoreTrash')->name('restore');
                Route::get('/forceDelete/{id}', 'forceDelete')->name('forceDelete');
                Route::post('/apply-discount', 'applyPromotion')->name('apply.promotion');
            });
        // Route Admin Review
        Route::controller(ReviewController::class)
            ->name('review.')
            ->prefix('review')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/{id}/destroy', 'destroy')->name('destroy');
            });
    });
});

// Login routes
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('profile/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.changePasswordForm');
Route::post('profile/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');

Route::get('/password/forgot', [UserController::class, 'showForgotPassword'])->name('password.forgot');
Route::post('/password/forgot', [UserController::class, 'sendOtp'])->name('password.sendOtp');
Route::post('/password/resend-otp', [UserController::class, 'resendOtp'])->name('password.resendOtp');


Route::get('/password/verify-otp', [UserController::class, 'showOtpForm'])->name('password.verifyOtp');
Route::post('/password/verify-otp', [UserController::class, 'verifyOtp'])->name('password.verifyOtp.post');

Route::get('/password/reset', [UserController::class, 'showResetPasswordForm'])->name('password.resetForm');
Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('password.reset');


// home routes
Route::get('/', [HomeClientController::class, 'home'])->name('home');
Route::get('/locations-by-characteristic/{id}', [HomeClientController::class, 'getLocationsByCharacteristic']);

//api locationgetBanner
Route::get('/api-locations', [ApiLoacationController::class, 'getLocations']);

// home detail client
Route::get('/{id}/hotel-details', [HotelDetailsController::class, 'hotelDetails'])->name('hotel-details')->middleware('checkHotelIdExists');
Route::get('/search-availability', [HotelDetailsController::class, 'searchAvailability'])->name('searchAvailability');
Route::post('/{id}/write-review', [HotelDetailsController::class, 'writeReview'])->name('writeReview');

Route::get('/{id}/hotels', [CategoryController::class, 'getHotelsByCategory'])->name('categories.hotels');

// Route client
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [HomeClientController::class, 'index'])->name('home');
    Route::get('/home', [HomeClientController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/filter-hotels', [SearchController::class, 'filterHotels'])->name('filter.hotels');

    // routes/web.php
    Route::get('/search-suggestions', [SearchController::class, 'getSearchSuggestions']);
});

// Route Booking Client
Route::controller(BookingController::class)->group(function () {
    Route::get('/booking-details', 'showBookingForm')->name('booking.details')->middleware('checkRoomSelection');
    Route::post('/booking-payment', 'informationPay')->name('booking.payment');
    Route::post('/save-booking', 'saveBooking')->name('save.booking');
    Route::get('/invoice/{booking_id}', 'showInvoice')->name('booking.invoice')->middleware('preventBack');
    Route::post('/vnpay-payment', 'vnp_payment')->name('vnpay.payment');
    Route::get('/vnpay-callback', 'handleVNPAYCallback')->name('vnpay.callback');
});

// Route User profiles (Không có {uuid} trong đường dẫn)
Route::prefix('users')->name('users.')->middleware(['checkLogin', 'verified'])->group(function () {
    Route::get('/booking-history', [UserController::class, 'showBookingHistory'])->name('bookingHistory');
    Route::delete('/booking/{id}/cancel', [UserController::class, 'cancelBooking'])->name('cancelBooking');
    Route::get('/profiles', [UserController::class, 'showDeviceManagement'])->name('showProfiles');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('showProfile');
    Route::get('/property', [UserController::class, 'showPropertyPage'])->name('property.page');
    Route::post('/property/start', [UserController::class, 'startPropertyRegistration'])->name('property.start');
    Route::get('/property/verify-otp', [UserController::class, 'showVerifyOtpPage'])->name('property.verify.otp');
    Route::post('/property/verify-otp', [UserController::class, 'verifyPropertyOtp'])->name('property.verifyOtp');
    Route::post('/profile/update-avatar', [UserController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/profile/update-name', [UserController::class, 'updateName'])->name('profile.name.update');
    Route::post('/profile/update-displayName', [UserController::class, 'updateDisplayName'])->name('profile.display_name.update');
    Route::post('/profile/update-email', [UserController::class, 'updateEmail'])->name('profile.email.update');
    Route::post('/profile/resend-verification-email', [UserController::class, 'resendVerificationEmail'])->name('profile.email.resend');
    Route::post('/profile/update-phone', [UserController::class, 'updatePhone'])->name('profile.phone.update');
    Route::post('/profile/update-birthday', [UserController::class, 'updateBirthday'])->name('profile.birthday.update');
    Route::post('/profile/update-nationality', [UserController::class, 'updateNationality'])->name('profile.nationality.update');
    Route::post('/profile/update-gender', [UserController::class, 'updateGender'])->name('profile.gender.update');
    Route::post('/profile/update-address', [UserController::class, 'updateAddress'])->name('profile.address.update');
    Route::post('/profile/update-passport', [UserController::class, 'updatePassport'])->name('profile.passport.update');
    Route::delete('/profile/delete-passport', [UserController::class, 'deletePassport'])->name('profile.passport.delete');
    Route::delete('/profile/delete-avatar', [UserController::class, 'deleteAvatar'])->name('profile.avatar.delete');

    //activity
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
});

Route::post('/devices/logout-all', [UserController::class, 'logoutAll'])->name('devices.logout-all');
Route::post('/devices/logout/{deviceId}', [UserController::class, 'logoutDevice'])->name('devices.logout');
Route::post('/apply-discount', [BookingController::class, 'applyPromotion'])->name('apply.promotion');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); // Điều hướng sau khi xác thực thành công
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function () {
    request()->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link xác thực đã được gửi lại.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/{lang}', [LanguageController::class, 'setLanguage'])->name('set-language')->where('lang', 'en|vi|fr');
Route::get('/pusher-config', function () {
    return response()->json([
        'key' => env('PUSHER_APP_KEY'),
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true,
    ]);
});
