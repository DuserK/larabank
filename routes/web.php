<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController as Cl;
use App\Http\Controllers\AccountController as Acc;
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
    return view('welcome');
});

// Clients
Route::prefix('/clients')->name('clients-')->group(function () {

    Route::get('/', [Cl::class, 'index'])->name('index');
    Route::get('/create', [Cl::class, 'create'])->name('create');
    Route::post('/', [Cl::class, 'store'])->name('store');
    Route::get('/edit/{client}', [Cl::class, 'edit'])->name('edit');
    Route::put('/{client}', [Cl::class, 'update'])->name('update');
    Route::get('/delete/{client}', [Cl::class, 'delete'])->name('delete'); // {client} - parametras (id - paimamas automatiskai kaip default reiksme)
    Route::delete('/{client}', [Cl::class, 'destroy'])->name('destroy');
});


// Users
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Accounts
Route::prefix('/accounts')->name('accounts-')->group(function () {

    Route::get('/', [Acc::class, 'index'])->name('index');
    Route::get('/create', [Acc::class, 'create'])->name('create');
    Route::post('/', [Acc::class, 'store'])->name('store');
    Route::get('/edit/{account}', [Acc::class, 'edit'])->name('edit');
    Route::put('/{account}', [Acc::class, 'update'])->name('update');
    Route::get('/delete/{account}', [Acc::class, 'delete'])->name('delete'); // {account} - parametras (id - paimamas automatiskai kaip default reiksme)
    Route::delete('/{account}', [Acc::class, 'destroy'])->name('destroy');
});