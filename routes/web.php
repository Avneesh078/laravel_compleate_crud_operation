<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormDataController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/', [FormDataController::class, 'index'])->name('form.index'); // List data
Route::get('/create', [FormDataController::class, 'create']); // Show form
Route::post('/store', [FormDataController::class, 'store'])->name('form.store'); // Store data
Route::get('/edit/{id}', [FormDataController::class, 'edit'])->name('form.edit'); // Edit form
Route::put('/update/{id}', [FormDataController::class, 'update'])->name('form.update'); // Update data
Route::delete('/delete/{id}', [FormDataController::class, 'destroy'])->name('form.destroy'); // Delete data
Route::get('/export-csv', [FormDataController::class, 'exportCsv'])->name('form.exportCsv'); // Export CSV

