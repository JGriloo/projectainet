<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::middleware('verified')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('clientes', [ClienteController::class, 'admin'])->name('clientes')
        ->middleware('can:viewAny,App\Models\Cliente');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit')
        ->middleware('can:view,cliente');
    Route::get('clientes/{cliente}/consult', [ClienteController::class, 'consult'])->name('clientes.consult')
        ->middleware('can:viewAny,cliente');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create')
        ->middleware('can:create,App\Models\Cliente');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store')
        ->middleware('can:create,App\Models\Cliente');
    Route::put('clientes/{cliente}/bloquear', [ClienteController::class, 'bloquear'])->name('clientes.bloquear')
        ->middleware('can:bloquear,cliente');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('clientes.foto.destroy')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'deleteCliente'])->name('clientes.deleteCliente')
        ->middleware('can:delete,cliente');
});
