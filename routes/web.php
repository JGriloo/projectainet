<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\EstatisticaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Encomenda;
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

Route::get('estampas', [EstampaController::class, 'admin'])->name('estampas');

Route::get('add-to-cart/{id}', [EstampaController::class, 'addToCart'])->name('estampas.addToCart');

Route::middleware('verified')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //CLIENTES
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
        ->middleware('can:doAny,App\Models\User');
    Route::get('funcionarios/{funcionario}/consult', [FuncionarioController::class, 'consult'])->name('funcionarios.consult')
        ->middleware('can:doAny,funcionario');
    Route::put('funcionarios/{funcionario}/bloqueado', [FuncionarioController::class, 'bloquear'])->name('funcionarios.bloquear')
        ->middleware('can:doAny,funcionario');
    Route::delete('funcionarios/{funcionario}', [FuncionarioController::class, 'delete'])->name('funcionarios.delete')
        ->middleware('can:doAny,funcionario');
    Route::get('funcionarios/funcionario', [FuncionarioController::class, 'create'])->name('funcionarios.create')
        ->middleware('can:doAny,App\Models\User');
    Route::post('funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store')
        ->middleware('can:doAny,App\Models\User');
    Route::put('funcionarios/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update')
        ->middleware('can:doAny,funcionario');
    Route::get('funcionarios/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit')
        ->middleware('can:doAny,funcionario');
    Route::delete('funcionarios/{funcionario}/foto', [FuncionarioController::class, 'destroy_foto'])->name('funcionarios.foto.destroy')
        ->middleware('can:doAny,funcionario');

        //ESTAMPAS
    Route::get('estampas/{estampa}/edit', [EstampaController::class, 'edit'])->name('estampas.edit')
        ->middleware('can:view,estampa');
    Route::get('estampas/{estampa}/consult', [EstampaController::class, 'consult'])->name('estampas.consult')
        ->middleware('can:viewAny,estampa');
    Route::get('estampas/create', [EstampaController::class, 'create'])->name('estampas.create')
        ->middleware('can:doAny,App\Models\Estampa');
    Route::post('estampas', [EstampaController::class, 'store'])->name('estampas.store')
        ->middleware('can:doAny,App\Models\Estampa');
    Route::put('estampas/{estampa}', [EstampaController::class, 'update'])->name('estampas.update')
        ->middleware('can:doAny,estampa');
    Route::delete('estampas/{estampa}/foto', [EstampaController::class, 'destroy_foto'])->name('estampas.foto.destroy')
        ->middleware('can:doAny,estampa');
    Route::delete('estampas/{estampa}', [EstampaController::class, 'delete'])->name('estampas.delete')
        ->middleware('can:doAny,estampa');
    Route::get('shopping-cart', [EstampaController::class, 'shoppingCart'])->name('estampas.shoppingCart');
    Route::get('delete-shopping-cart', [EstampaController::class, 'deleteFromCart'])->name('estampas.delete.shoppingCart');


    //Encomendas
    Route::get('historicoEncomendasCliente', [EncomendaController::class, 'historicoEncomendasCliente'])->name('historico.encomendas.cliente');
    Route::get('encomendasFuncionario', [EncomendaController::class, 'encomendasFuncionario'])->name('encomendas.funcionario');
    Route::get('encomendasAdministrador', [EncomendaController::class, 'encomendasAdministrador'])->name('encomendas.administrador');
    Route::post('checkout', [EncomendaController::class, 'checkout'])->name('checkout');
    Route::put('encomendas/{encomenda}/paga', [EncomendaController::class, 'encomendaPaga'])->name('encomenda.paga')
        ->middleware('can:funcionariosAndAdmins,encomenda');
    Route::put('encomendas/{encomenda}/fechada', [EncomendaController::class, 'encomendaFechada'])->name('encomenda.fechada')
        ->middleware('can:funcionariosAndAdmins,encomenda');
    Route::put('encomendas/{encomenda}/anulada', [EncomendaController::class, 'encomendaAnulada'])->name('encomenda.anulada')
        ->middleware('can:administradores,encomenda');

    //Estatistica
    Route::get('estatisticas', [EstatisticaController::class, 'admin'])->name('estatisticas')
        ->middleware('can:administradores,App\Models\Encomenda');
    Route::get('estatisticas/sort', [EstatisticaController::class, 'sort'])->name('estatisticas.sort')
        ->middleware('can:administradores,App\Models\Encomenda');
    Route::get('estatisticas/dataSort', [EstatisticaController::class, 'dataSort'])->name('estatisticas.dataSort')
        ->middleware('can:administradores,App\Models\Encomenda');
    Route::get('estatisticas/clienteSort', [EstatisticaController::class, 'clienteSort'])->name('estatisticas.clienteSort')
        ->middleware('can:viewAny,App\Models\Cliente');
    Route::get('estatisticas/estampaSort', [EstatisticaController::class, 'estampaSort'])->name('estatisticas.estampaSort')
        ->middleware('can:administradores,App\Models\Encomenda');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
