<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
Route::get('/', [BookingUserController::class, 'welcome'])->name('welcome');
Route::get('/jadwal/{lapangan}', [BookingUserController::class, 'showjadwal'])->name('jadwal.show');
Route::get('/jadwal', [BookingUserController::class, 'jadwal'])->name('jadwal');


Route::middleware('auth')->group(function(){
    Route::resource('bookinguser', BookingUserController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
});
Route::middleware('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('lapangan', LapanganController::class);
    Route::resource('booking', BookingController::class);
    Route::patch('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    //user
    Route::resource('/user', UserController::class);
    Route::patch('/user/{user}/makeadmin', [UserController::class, 'makeadmin'])->name('user.makeadmin');
    Route::patch('/user/{user}/removeadmin', [UserController::class, 'removeadmin'])->name('user.removeadmin');
});

require __DIR__.'/auth.php';
