<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login'); // No es necesario el slash "/login"
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/tables', [TableController::class, 'index']);

    Route::get('/reservas', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservas/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservas/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservas/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservas/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});
