<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/listarpizza',[App\Http\Controllers\ListarPizzaController::class, 'getLista']);
//Route::resource('/listarpizza','ListarPizzaController@getLista');
Route::resource('controlpizzas',App\Http\Controllers\GestionarPizzasController::class);
Route::resource('controlingredientes',App\Http\Controllers\GestionIngredientesController::class);
Route::resource('controlpedidos',App\Http\Controllers\GestionPedidosController::class,['except'=>['create','show','update','destroy','edit']]);