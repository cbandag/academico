<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas de Auth
Route::group(['middleware' =>  'auth'],function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('home');

    /* Periodos */
    Route::resource('periodos', PeriodosController::class)->middleware('auth');

    /* Usuarios */
    Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios.index');
    Route::post('/jefes/import',[App\Http\Controllers\UsuariosController::class, 'importJefes'])->name('usuarios.importjefes');
    Route::get('/jefes/export',[App\Http\Controllers\UsuariosController::class, 'exportJefes'])->name('usuarios.exportjefes');
    Route::get('/jefes/create',[App\Http\Controllers\UsuariosController::class, 'createJefes'])->name('usuarios.createjefes');
    Route::post('/jefes/store',[App\Http\Controllers\UsuariosController::class, 'storeJefes'])->name('usuarios.storejefes');
    Route::get('/jefes/{id}/edit',[App\Http\Controllers\UsuariosController::class, 'editJefes'])->name('usuarios.editjefes');
    Route::put('/jefes/{id}',[App\Http\Controllers\UsuariosController::class, 'updateJefes'])->name('usuarios.updatejefes');
    Route::post('/docentes/import',[App\Http\Controllers\UsuariosController::class, 'importDocentes'])->name('usuarios.importdocentes');
    Route::get('/docentes/export',[App\Http\Controllers\UsuariosController::class, 'exportDocentes'])->name('usuarios.exportdocentes');
    Route::get('/docentes/create',[App\Http\Controllers\UsuariosController::class, 'createDocentes'])->name('usuarios.createdocentes');
    Route::post('/docentes/store',[App\Http\Controllers\UsuariosController::class, 'storeDocentes'])->name('usuarios.storedocentes');
    Route::get('/docentes/{id}/edit',[App\Http\Controllers\UsuariosController::class, 'editDocentes'])->name('usuarios.editdocentes');
    Route::put('/docentes/{id}',[App\Http\Controllers\UsuariosController::class, 'updateDocentes'])->name('usuarios.updatedocentes');
    Route::get('/jefesprovisionales/create',[App\Http\Controllers\UsuariosController::class, 'createJefesProvisionales'])->name('usuarios.createjefesprovisionales');
    Route::post('/jefesprovisionales/store',[App\Http\Controllers\UsuariosController::class, 'storeJefesprovisionales'])->name('usuarios.storejefesprovisionales');
    Route::get('/jefesprovisionales/{id}/edit',[App\Http\Controllers\UsuariosController::class, 'editJefesprovisionales'])->name('usuarios.editjefesprovisionales');
    Route::put('/jefesprovisionales/{id}',[App\Http\Controllers\UsuariosController::class, 'updateJefesprovisionales'])->name('usuarios.updatejefesprovisionales');

    Route::get('/docentes/jefe/{id}',[App\Http\Controllers\UsuariosController::class, 'docentesPorJefe'])->name('usuarios.docentesporjefe');
    Route::put('/docentes/{id}/reset_password',[App\Http\Controllers\UsuariosController::class, 'reset_password'])->name('usuarios.reset_password');


    /* asignaciones */
    Route::get('/asignaciones/', [App\Http\Controllers\AsignacionesController::class, 'index'])->name('asignaciones.index');
    Route::get('/asignaciones/{id}', [AsignacionesController::class, 'show'])->name('asignaciones.show');
    Route::get('/asignaciones/{id}/edit', [AsignacionesController::class, 'edit'])->name('asignaciones.edit');
    Route::put('/asignaciones/{id}', [AsignacionesController::class, 'update'])->name('asignaciones.update');
    Route::post('/asignaciones/año/', [App\Http\Controllers\AsignacionesController::class, 'año'])->name('asignaciones.año');
    Route::get('/asignaciones/jefe/{id}',[App\Http\Controllers\AsignacionesController::class, 'jefe'])->name('asignaciones.jefe');
    Route::get('/asignaciones/{id}/importasignaturas/',[App\Http\Controllers\AsignacionesController::class, 'importAsignaturas'])->name('asignaciones.importAsignaturas');


    /* asignaciones */
    Route::get('/planes/', [App\Http\Controllers\UsuariosController::class, 'index'])->name('planes.index');
    Route::get('/planes/{id}', [DocentesController::class, 'show'])->name('planes.show');
    Route::get('/planes/{id}/edit', [DocentesController::class, 'edit'])->name('planes.edit');
    Route::put('/planes/{id}', [DocentesController::class, 'update'])->name('planes.update');
    Route::post('/planes/año/', [App\Http\Controllers\AsignacionesController::class, 'año'])->name('planes.año');
    Route::get('/planes/jefe/{id}',[App\Http\Controllers\AsignacionesController::class, 'jefe'])->name('planes.jefe');
    Route::get('/planes/{id}/importasignaturas/',[App\Http\Controllers\AsignacionesController::class, 'importAsignaturas'])->name('planes.importAsignaturas');


    /* programaciones */
    Route::get('/programaciones/', [App\Http\Controllers\UsuariosController::class, 'index'])->name('programaciones.index');
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

