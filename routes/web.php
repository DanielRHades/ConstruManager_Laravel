<?php

use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\Suppliers_MaterialsController;
use App\Http\Controllers\MachineryController;
use App\Models\Supplier;
use App\Http\Controllers\ContractsController;

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


//

Route::get('/materials', [MaterialsController::class, 'getItems'])->middleware(['auth', 'verified'])->name('materiales');

Route::get('/materials/{id}', [MaterialsController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified']);

Route::get('/materials/{id}/{category}', [MaterialsController::class, 'getItemRelationInfo'])->where(['id' => '[0-9]+', 'category' => '[a-z]+'])->middleware(['auth', 'verified']);

Route::get('/machinery', [MachineryController::class, 'getItems'])->middleware(['auth', 'verified'])->name('maquinarias');
Route::get('/machinery/{id}', [MachineryController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified']);

Route::get('/suppliers', [SuppliersController::class, 'getItems'])->middleware(['auth', 'verified'])->name('proveedores');
Route::get('/suppliers/{id}', [SuppliersController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified']);
Route::get('/suppliers/{id}/{category}', [SuppliersController::class, 'getItemRelationInfo'])->where(['id' => '[0-9]+', 'category' => '[a-z]+'])->middleware(['auth', 'verified']);

Route::get('/contracts', [ContractsController::class, 'getItems'])->middleware(['auth', 'verified'])->name('contratos');
Route::get('/contracts/{id}', [ContractsController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified']);
Route::get('/contracts/{id}/{category}', [ContractsController::class, 'getItemRelationInfo'])->where(['id' => '[0-9]+', 'category' => '[a-z]+'])->middleware(['auth', 'verified']);



Route::post('/materials', [MaterialsController::class, 'store'])->name('materials.store');

Route::post('/machinery', [MachineryController::class, 'store'])->name('machinery.store');

Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');

//

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
