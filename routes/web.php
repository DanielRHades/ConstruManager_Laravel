<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth.register');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/contracts', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('contratos');
Route::get('/dashboard/suppliers', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('proveedores');
Route::get('/dashboard/materials', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('materiales');
Route::get('/dashboard/machinery', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('maquinaria');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
