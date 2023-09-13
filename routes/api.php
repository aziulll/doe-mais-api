<?php

use App\Http\Controllers\DoacoesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('registrar' , [UserController::class, 'register'])->name('registrar');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('users/all', [UserController::class, 'index']);

Route::post('logout', [UserController::class, 'logout'])->name('logout');


Route::post('nova-doacao', [DoacoesController::class, 'store'])->name('doacao.store');
Route::get('minhas-doacoes', [DoacoesController::class, 'index'])->name('doacao.index');