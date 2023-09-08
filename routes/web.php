<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JefesController;
use App\Http\Controllers\DecanosController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\PeriodosController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\ProgramasController;
use App\Http\Controllers\ActividadesController;

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

/*Route::get('/', function () {
    return view('auth.login');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas de Auth

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' =>  'auth'],function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('home');
});


//Route::get('/periodo/index', [PeriodosController::class,'index']);
//Route::resource('user', UsersController::class)->middleware('auth');
Route::resource('docentes', DocentesController::class)->middleware('auth');
Route::resource('periodos', PeriodosController::class)->middleware('auth');
Route::resource('facultades', FacultadesController::class)->middleware('auth');
Route::resource('programas', ProgramasController::class)->middleware('auth');
Route::resource('actividades', ActividadesController::class)->middleware('auth');

/*
Route::get('/docentes', [DocentesController::class, 'index'])->name('docentes.index');
Route::post('/docentes/', [DocentesController::class, 'store'])->name('docentes.store');
Route::get('/docentes/create', [DocentesController::class, 'create'])->name('docentes.create');
Route::get('/docentes/{id}', [DocentesController::class, 'show'])->name('docentes.show');
Route::put('/docentes/{id}', [DocentesController::class, 'update'])->name('docentes.update');
Route::delete('/docentes/{id}', [DocentesController::class, 'destroy'])->name('docentes.destroy');
Route::get('/docentes/{id}/edit', [DocentesController::class, 'edit'])->name('docentes.edit');
*/