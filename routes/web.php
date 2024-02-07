<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\JefesController;
use App\Http\Controllers\DecanosController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Rutas de Auth
Route::group(['middleware' =>  'auth'],function () {
    Route::get('/', [LoginController::class,'index'])->name('home');

    /* Periodos */
    Route::resource('periodos', PeriodosController::class);

    /* Usuarios */
    Route::get('/usuarios', [UsuariosController::class, 'index'])->middleware('can:usuarios.index')->name('usuarios.index');
    Route::post('/jefes/import',[UsuariosController::class, 'importJefes'])->middleware('can:usuarios.importjefes')->name('usuarios.importjefes');
    Route::get('/jefes/export',[UsuariosController::class, 'exportJefes'])->middleware('can:usuarios.exportjefes')->name('usuarios.exportjefes');
    Route::get('/jefes/create',[UsuariosController::class, 'createJefes'])->middleware('can:usuarios.createjefes')->name('usuarios.createjefes');
    Route::post('/jefes/store',[UsuariosController::class, 'storeJefes'])->middleware('can:usuarios.storejefes')->name('usuarios.storejefes');
    Route::get('/jefes/{id}/edit',[UsuariosController::class, 'editJefes'])->middleware('can:usuarios.editjefes')->name('usuarios.editjefes');
    Route::put('/jefes/{id}',[UsuariosController::class, 'updateJefes'])->middleware('can:usuarios.updatejefes')->name('usuarios.updatejefes');
    Route::post('/docentes/import',[UsuariosController::class, 'importDocentes'])->middleware('can:usuarios.importdocentes')->name('usuarios.importdocentes');
    Route::get('/docentes/export',[UsuariosController::class, 'exportDocentes'])->middleware('can:usuarios.exportdocentes')->name('usuarios.exportdocentes');
    Route::get('/docentes/create',[UsuariosController::class, 'createDocentes'])->middleware('can:usuarios.createdocentes')->name('usuarios.createdocentes');
    Route::post('/docentes/store',[UsuariosController::class, 'storeDocentes'])->middleware('can:usuarios.storedocentes')->name('usuarios.storedocentes');
    Route::get('/docentes/{id}/edit',[UsuariosController::class, 'editDocentes'])->middleware('can:usuarios.editdocentes')->name('usuarios.editdocentes');
    Route::put('/docentes/{id}',[UsuariosController::class, 'updateDocentes'])->middleware('can:usuarios.updatedocentes')->name('usuarios.updatedocentes');
    Route::get('/jefesprovisionales/create',[UsuariosController::class, 'createJefesProvisionales'])->middleware('can:usuarios.createjefesprovisionales')->name('usuarios.createjefesprovisionales');
    Route::post('/jefesprovisionales/store',[UsuariosController::class, 'storeJefesprovisionales'])->middleware('can:usuarios.storejefesprovisionales')->name('usuarios.storejefesprovisionales');
    Route::get('/jefesprovisionales/{id}/edit',[UsuariosController::class, 'editJefesprovisionales'])->middleware('can:usuarios.editjefesprovisionales')->name('usuarios.editjefesprovisionales');
    Route::put('/jefesprovisionales/{id}',[UsuariosController::class, 'updateJefesprovisionales'])->middleware('can:usuarios.updatejefesprovisionales')->name('usuarios.updatejefesprovisionales');

    Route::get('/docentes/jefe/{id}',[UsuariosController::class, 'docentesPorJefe'])->middleware('can:usuarios.docentesporjefe')->name('usuarios.docentesporjefe');
    Route::put('/docentes/{id}/reset_password',[UsuariosController::class, 'reset_password'])->middleware('can:usuarios.reset_password')->name('usuarios.reset_password');


    /* asignaciones */
    Route::get('/asignaciones/asignador', [AsignacionesController::class, 'index_asignador'])->middleware('can:asignaciones.index_asignador')->name('asignaciones.index_asignador');
    Route::get('/asignaciones/jefe/', [AsignacionesController::class, 'index_jefe'])->middleware('can:asignaciones.index_jefe')->name('asignaciones.index_jefe');
    //Route::get('/asignaciones/{id}', [AsignacionesController::class, 'show'])->middleware('can:asignaciones.show')->name('asignaciones.show');
    Route::get('/asignaciones/{id}/edit', [AsignacionesController::class, 'edit'])->middleware('can:asignaciones.edit')->name('asignaciones.edit');
    Route::put('/asignaciones/{id}', [AsignacionesController::class, 'update'])->middleware('can:asignaciones.update')->name('asignaciones.update');
    Route::post('/asignaciones/año/', [AsignacionesController::class, 'año'])->middleware('can:asignaciones.año')->name('asignaciones.año');
    Route::get('/asignaciones/{id}/importasignaturas/',[AsignacionesController::class, 'importAsignaturas'])->middleware('can:asignaciones.importAsignaturas')->name('asignaciones.importAsignaturas');
    Route::get('/asignaciones/{asignacion_id}/{funcion_id}/download/',[AsignacionesController::class, 'downloadFuncion'])->middleware('can:asignaciones.downloadFuncion')->name('asignaciones.downloadFuncion');


    /* asignaciones */
    Route::get('/planes/', [UsuariosController::class, 'index'])->middleware('can:planes.index')->name('planes.index');
    Route::get('/planes/{id}', [DocentesController::class, 'show'])->middleware('can:planes.show')->name('planes.show');
    Route::get('/planes/{id}/edit', [DocentesController::class, 'edit'])->middleware('can:planes.edit')->name('planes.edit');
    Route::put('/planes/{id}', [DocentesController::class, 'update'])->middleware('can:planes.update')->name('planes.update');
    Route::post('/planes/año/', [AsignacionesController::class, 'año'])->middleware('can:planes.año')->name('planes.año');
    Route::get('/planes/jefe/{id}',[AsignacionesController::class, 'jefe'])->middleware('can:planes.jefe')->name('planes.jefe');
    Route::get('/planes/{id}/importasignaturas/',[AsignacionesController::class, 'importAsignaturas'])->middleware('can:planes.importAsignaturas')->name('planes.importAsignaturas');


    /* programaciones */
    Route::get('/programaciones/', [UsuariosController::class, 'index'])->name('programaciones.index');
});



/*
Route::get('asignaciones/{id}', ['as' => 'asignaciones.index', 'uses' => 'asignacionesController@index']);
Route::resource('asignaciones', 'ScopesController', ['except' => ['index']]);

*/

/*
Route::get('/docentes', [DocentesController::class, 'index'])->name('docentes.index')->middleware('auth');
Route::post('/docentes/', [DocentesController::class, 'store'])->name('docentes.store');
Route::get('/docentes/create', [DocentesController::class, 'create'])->name('docentes.create');
Route::get('/docentes/{id}', [DocentesController::class, 'show'])->name('docentes.show');
Route::put('/docentes/{id}', [DocentesController::class, 'update'])->name('docentes.update');
Route::delete('/docentes/{id}', [DocentesController::class, 'destroy'])->name('docentes.destroy');
Route::get('/docentes/{id}/edit', [DocentesController::class, 'edit'])->name('docentes.edit');
*/

