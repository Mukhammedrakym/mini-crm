<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TicketController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin|manager'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/tickets', [TicketController::class, 'index'])
            ->name('tickets.index');

        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
            ->name('tickets.show');

        Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
            ->name('tickets.updateStatus');
    });
