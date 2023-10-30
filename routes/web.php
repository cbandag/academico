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
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\ProgramacionesController;

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


Route::get('/programaciones/docentes', [App\Http\Controllers\ProgramacionesController::class, 'importDocentes'])->name('programaciones.importDocentes')->middleware('auth');
Route::get('/programaciones/asignaturas', [App\Http\Controllers\ProgramacionesController::class, 'importAsignaturasPorDocente'])->name('programaciones.importAsignaturasPorDocente')->middleware('auth');
Route::get('/asignaciones/import', [App\Http\Controllers\AsignacionesController::class, 'import'])->name('programaciones.import')->middleware('auth');
Route::get('/asignaciones/export', [App\Http\Controllers\AsignacionesController::class, 'export'])->name('programaciones.export')->middleware('auth');
Route::post('/asignaciones/año/', [App\Http\Controllers\AsignacionesController::class, 'año'])->name('asignaciones.año')->middleware('auth');

Route::post('/periodos/import',[App\Http\Controllers\PeriodosController::class, 'import'])->name('programaciones.import')->middleware('auth');
Route::get('/periodos/export',[App\Http\Controllers\PeriodosController::class, 'export'])->name('programaciones.export')->middleware('auth');

Route::post('/jefes/import',[App\Http\Controllers\DocentesController::class, 'importJefes'])->name('jefes.import')->middleware('auth');
Route::get('/jefes/export',[App\Http\Controllers\DocentesController::class, 'exportJefes'])->name('jefes.export')->middleware('auth');

Route::post('/docentes/import',[App\Http\Controllers\DocentesController::class, 'importDocentes'])->name('docentes.import')->middleware('auth');
Route::get('/docentes/export',[App\Http\Controllers\DocentesController::class, 'exportDocentes'])->name('docentes.export')->middleware('auth');

Route::put('/docentes/{id}/reset_password',[App\Http\Controllers\DocentesController::class, 'reset_password'])->name('docentes.reset_password')->middleware('auth');

Route::get('/asignaciones/jefe/{id}',[App\Http\Controllers\AsignacionesController::class, 'jefe'])->name('asignaciones.jefe')->middleware('auth');





//Route::get('/periodo/index', [PeriodosController::class,'index']);
//Route::resource('user', UsersController::class)->middleware('auth');
Route::resource('docentes', DocentesController::class)->middleware('auth');
//Route::resource('jefes', JefesController::class)->middleware('auth');
Route::resource('decanos', DecanosController::class)->middleware('auth');
Route::resource('periodos', PeriodosController::class)->middleware('auth');
Route::resource('facultades', FacultadesController::class)->middleware('auth');
Route::resource('programas', ProgramasController::class)->middleware('auth');
Route::resource('programaciones', ProgramacionesController::class)->middleware('auth');
Route::resource('asignaciones', AsignacionesController::class)->middleware('auth');
Route::resource('planes', AsignacionesController::class)->middleware('auth');


/*
Route::get('asignaciones/{id}', ['as' => 'asignaciones.index', 'uses' => 'asignacionesController@index']);
Route::resource('asignaciones', 'ScopesController', ['except' => ['index']]);

*/

/*
Route::get('/docentes', [DocentesController::class, 'index'])->name('docentes.index');
Route::post('/docentes/', [DocentesController::class, 'store'])->name('docentes.store');
Route::get('/docentes/create', [DocentesController::class, 'create'])->name('docentes.create');
Route::get('/docentes/{id}', [DocentesController::class, 'show'])->name('docentes.show');
Route::put('/docentes/{id}', [DocentesController::class, 'update'])->name('docentes.update');
Route::delete('/docentes/{id}', [DocentesController::class, 'destroy'])->name('docentes.destroy');
Route::get('/docentes/{id}/edit', [DocentesController::class, 'edit'])->name('docentes.edit');
*/

Route::get('/docentes/jefe/{id}',function ($id) {
    return "Hola esta es una ruta";
})->middleware('auth');

Route::get('/docentes/jefe/{id}',[App\Http\Controllers\DocentesController::class, 'docentesPorJefe'])->name('docentes.docentesporjefe')->middleware('auth');
