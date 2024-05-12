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
use App\Http\Controllers\Auth\RegisteredUserController;

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
    return view('auth.login');
});


//

Route::get('/records/{id}', [RecordsController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('records.details');
Route::post('/records/edit/', [RecordsController::class, 'updateItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('records.edit');
Route::post('/records/delete/', [RecordsController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('records.delete');

Route::get('/materials', [MaterialsController::class, 'getItems'])->middleware(['auth', 'verified'])->name('materiales');
Route::get('/materials/{id}', [MaterialsController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('materials.details');
Route::post('/materials/edit/{id}', [MaterialsController::class, 'updateItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('materials.edit');
Route::get('/materials/delete/{id}', [MaterialsController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('materials.delete');

Route::get('/machinery', [MachineryController::class, 'getItems'])->middleware(['auth', 'verified'])->name('maquinarias');
Route::get('/machinery/{id}', [MachineryController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('machinery.details');
Route::post('/machinery/edit/{id}', [MachineryController::class, 'updateItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('machinery.edit');
Route::get('/machinery/delete/{id}', [MachineryController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('machinery.delete');

Route::get('/suppliers', [SuppliersController::class, 'getItems'])->middleware(['auth', 'verified'])->name('proveedores');
Route::get('/suppliers/{id}', [SuppliersController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('suppliers.details');
Route::post('/suppliers/suppliers/{id}', [SuppliersController::class, 'updateItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('suppliers.edit');
Route::get('/suppliers/delete/{id}', [SuppliersController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('suppliers.delete');

Route::get('/contracts', [ContractsController::class, 'getItems'])->middleware(['auth', 'verified'])->name('contratos');
Route::get('/contracts/{id}', [ContractsController::class, 'getItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contracts.details');
Route::get('/contracts/{id}/{category}', [ContractsController::class, 'getItemRelationInfo'])->where(['id' => '[0-9]+', 'category' => '[a-z]+'])->middleware(['auth', 'verified'])->name('contracts.categories');
Route::post('/contracts/edit/{id}', [ContractsController::class, 'updateItemDetails'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contracts.edit');
Route::get('/contracts/delete/{id}', [ContractsController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contracts.delete');

Route::post('/suppliers_materials/delete', [Suppliers_MaterialsController::class, 'deleteRelation'])->middleware(['auth', 'verified'])->name('suppliers_materials.delete');
Route::post('/contacts/delete/', [ContactsController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contacts.delete');
Route::post('/contracts_materials/delete/', [Contracts_MaterialsController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contracts_materials.delete');
Route::post('/contracts_machinery/delete/', [Contracts_MachineryController::class, 'deleteItem'])->where(['id' => '[0-9]+'])->middleware(['auth', 'verified'])->name('contracts_machinery.delete');


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
