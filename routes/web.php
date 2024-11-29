<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function() {
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Rute untuk dashboard dengan middleware auth


// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// routes/web.php

Route::get('/events', [EventController::class, 'index']);  // GET untuk mengambil event
Route::post('/events', [EventController::class, 'store']);  // POST untuk menyimpan event

Route::middleware('auth')->group(function() {
    Route::resource('/materi', MateriController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
});





