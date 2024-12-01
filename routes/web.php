<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GroupControll;
use App\Http\Controllers\GroupController;

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


    // Route::get('/group', [GroupControll::class, 'index'])->name('group.index');
    // Route::resource('/group', GroupControll::class)->except(['show']);
    // Route::get('/group/{group}', [GroupControll::class, 'show'])->name('group.show');
    // Route::post('/group/{group}/join', [GroupControll::class, 'join'])->name('group.join');
    // Route::post('/group/{group}/leave', [GroupControll::class, 'leave'])->name('group.leave');
    // Route::get('/group/search', [GroupControll::class, 'search'])->name('group.search');

});

Route::middleware('auth')->group(function () {
    Route::resource('/group', GroupControll::class);
    Route::post('/groups/create', [GroupControll::class, 'create'])->name('groups.create');
    Route::get('groups/create', [GroupController::class, 'create'])->name('groups.create');

    Route::post('/groups/join/{group}', [GroupController::class, 'join'])->name('groups.join');

    Route::get('/group', [GroupControll::class, 'index'])->name('group.index');
    Route::resource('/group', GroupControll::class)->except(['show']);
    Route::get('/group/{group}', [GroupControll::class, 'show'])->name('group.show');
    Route::post('/group/{group}/join', [GroupControll::class, 'join'])->name('group.join');
    Route::post('/group/{group}/leave', [GroupControll::class, 'leave'])->name('group.leave');
    Route::get('/group/search', [GroupControll::class, 'search'])->name('group.search');

    // Route::post('/groups/create', [GroupControll::class, 'create'])->name('groups.create');
    Route::get('/group/chat/{group}', [GroupControll::class, 'chat'])->name('group.chat');
    Route::post('/groups/create', [GroupControll::class, 'store'])->name('groups.store');
    Route::post('/groups/join/{id}', [GroupControll::class, 'join'])->name('groups.join');

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







