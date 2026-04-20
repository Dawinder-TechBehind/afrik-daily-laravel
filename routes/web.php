<?php

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;







// ==================== daw route start from here 

Route::get('/verify-otp', [OtpController::class, 'create'])->name('otp-show');
Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp-verify')->middleware('throttle:5,1');

Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend')->middleware('throttle:3,1'); // 3 attempts per minute

// ============================






Route::get('/', function () {
    return view('public.home.home');

    // return view('welcome');
})->name('home');



Route::get('/all-properties', function () {
    return view('public.properties.properties');
    // return view('welcome');
});
Route::get('/property-details', function () {
    return view('public.property.property');
    // return view('welcome');
});

Route::get('/reset-password', function () {
    return view('public.auth.reset-password');
    // return view('welcome');
});
Route::get('/forget-password', function () {
    return view('public.auth.forgot-password');
    // return view('welcome');
});
Route::get('/setup-profile', function () {
    return view('public.auth.setup-profile');
    // return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.index');
    }
    return redirect()->route('investor.index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard.welcome');
        })->name('index');

        Route::get('/users', [UserController::class, 'list'])->name('users.list');

        // KYC Review Routes
        Route::get('/kyc', [\App\Http\Controllers\Admin\KYCReviewController::class, 'index'])->name('kyc.index');
        Route::get('/kyc/{user}/review', [\App\Http\Controllers\Admin\KYCReviewController::class, 'show'])->name('kyc.review');
        Route::post('/kyc/{user}/approve', [\App\Http\Controllers\Admin\KYCReviewController::class, 'approve'])->name('kyc.approve');
        Route::post('/kyc/{user}/reject', [\App\Http\Controllers\Admin\KYCReviewController::class, 'reject'])->name('kyc.reject');
        Route::post('/kyc/save-step', [\App\Http\Controllers\Admin\KycController::class, 'saveStep'])->name('kyc.save');
        Route::get('/kyc/states', [\App\Http\Controllers\Admin\KycController::class, 'getStates'])->name('kyc.states');
        Route::get('/kyc/cities', [\App\Http\Controllers\Admin\KycController::class, 'getCities'])->name('kyc.cities');

    });


Route::middleware(['auth', 'role:investor'])
    ->prefix('investor')
    ->name('investor.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard.welcome');
        })->name('index');

        Route::get('/kyc', [\App\Http\Controllers\Admin\KycController::class, 'index'])->name('kyc.index');
        Route::post('/kyc/save-step', [\App\Http\Controllers\Admin\KycController::class, 'saveStep'])->name('kyc.save');
        Route::get('/kyc/states', [\App\Http\Controllers\Admin\KycController::class, 'getStates'])->name('kyc.states');
        Route::get('/kyc/cities', [\App\Http\Controllers\Admin\KycController::class, 'getCities'])->name('kyc.cities');

    });


require __DIR__ . '/auth.php';
