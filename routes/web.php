<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
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
Route::get('/4-modal', [EventController::class, 'showModal'])->name('components.4-modal');

Route::middleware('auth')->group(function() {
    Route::resource('/materi', MateriController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::put('/materi', [MateriController::class, 'update']);

    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    

});


Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);







Route::middleware('auth')->group(function() {
    Route::resource('/materi', MateriController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
});





