<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\Suppliers_MaterialsController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\Contracts_MaterialsController;
use App\Http\Controllers\Contracts_MachineryController;
use App\Http\Controllers\RecordsController;

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

Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');

Route::post('/materials', [MaterialsController::class, 'store'])->name('materials.store');

Route::post('/contracts', [ContractsController::class, 'store'])->name('contracts.store');

Route::post('/contracts/customers', [CustomersController::class, 'store'])->name('customers.store');

Route::post('/contracts/contacts', [ContactsController::class, 'store'])->name('contacts.store');

Route::post('/contracts/materials', [Contracts_MaterialsController::class, 'store'])->name('contracts_materials.store');

Route::post('/contracts/machinery', [Contracts_MachineryController::class, 'store'])->name('contracts_machinery.store');

Route::post('/contracts/records', [RecordsController::class, 'store'])->name('records.store');


Route::post('/machinery', [MachineryController::class, 'store'])->name('machinery.store');

Route::post('/suppliers/suppliers_materials', [Suppliers_MaterialsController::class, 'store'])->name('suppliers_materials.store');
//

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
