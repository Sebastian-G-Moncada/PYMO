<?php

use App\Livewire\Bienvenido;
use App\Livewire\Dashboard;
use App\Livewire\Hospitales;
use App\Livewire\Insumo;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::get('/Insumo', Insumo::class)->name('Insumo');

Route::get('/Hospitales', Hospitales::class)->name('Hospitales');
