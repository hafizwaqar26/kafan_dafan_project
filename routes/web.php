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

    Route::get('ghassal-export-excel', [GhassalRecordController::class, 'exportExcel'])
        ->name('ghassal.export.excel');

    Route::get('ghassal-export-pdf', [GhassalRecordController::class, 'ghassalExportPdf'])
        ->name('ghassal.export.pdf');

    // Location AJAX routes
    Route::get('get-provinces/{countryId}', [GhassalRecordController::class, 'getProvinces']);
    Route::get('get-divisions/{provinceId}', [GhassalRecordController::class, 'getDivisions']);
    Route::get('get-districts/{divisionId}', [GhassalRecordController::class, 'getDistricts']);
    Route::get('get-tehsils/{districtId}', [GhassalRecordController::class, 'getTehsils']);
    Route::get('get-sub-tehsils/{tehsilId}', [GhassalRecordController::class, 'getSubTehsils']);
    Route::get('get-ucs/{subTehsilId}', [GhassalRecordController::class, 'getUcs']);
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
