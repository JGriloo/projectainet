<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
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
    Route::put('clientes/{cliente}/bloqueado', [ClienteController::class, 'bloquear'])->name('clientes.bloquear')
        ->middleware('can:bloquear,cliente');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('clientes.foto.destroy')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'delete'])->name('clientes.delete')
        ->middleware('can:delete,cliente');


    Route::get('funcionarios', [FuncionarioController::class, 'admin'])->name('funcionarios')
        ->middleware('can:viewAny,App\Models\User');
    Route::get('funcionarios/{funcionario}/consult', [FuncionarioController::class, 'consult'])->name('funcionarios.consult')
        ->middleware('can:viewAny,funcionario');
    Route::put('funcionarios/{funcionario}/bloqueado', [FuncionarioController::class, 'bloquear'])->name('funcionarios.bloquear')
        ->middleware('can:bloquear,funcionario');
    Route::delete('funcionarios/{funcionario}', [FuncionarioController::class, 'delete'])->name('funcionarios.delete')
        ->middleware('can:delete,funcionario');
    Route::get('funcionarios/funcionario', [FuncionarioController::class, 'create'])->name('funcionarios.create')
        ->middleware('can:create,App\Models\User');
    Route::post('funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store')
        ->middleware('can:create,App\Models\User');
    Route::put('funcionarios/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update')
        ->middleware('can:update,funcionario');
    Route::get('funcionarios/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit')
        ->middleware('can:update,funcionario');
    Route::delete('funcionarios/{funcionario}/foto', [FuncionarioController::class, 'destroy_foto'])->name('funcionarios.foto.destroy')
        ->middleware('can:update,funcionario');
});
