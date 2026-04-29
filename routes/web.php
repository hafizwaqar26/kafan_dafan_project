<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GhassalRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('ghassal.index');
});

// Only logged‑in user can access these
Route::middleware(['auth'])->group(function () {
    Route::resource('ghassal', GhassalRecordController::class);

    Route::get('ghassal-export-csv', [GhassalRecordController::class, 'exportExcel'])
        ->name('ghassal.export.csv');

    Route::get('ghassal-export-pdf', [GhassalRecordController::class, 'ghassalExportPdf'])
        ->name('ghassal.export.pdf');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
