<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\MateriaDocenteController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group ([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/registerMany', [AuthController::class, 'registerMany']);

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('dummyy', [AuthController::class, 'dummyGet']);
});



Route::get('users/{nombre}/id', [UserController::class, 'obtenerIdPorNombre']);

//Rutas de los ambientes
Route::get('/ambientes', [AmbienteController::class, 'index'])->name('ambientes.index');
Route::post('/ambientes', [AmbienteController::class, 'store'])->name('ambientes.store');
Route::get('/ambientes/{ambiente}', [AmbienteController::class, 'show'])->name('ambientes.show');
Route::put('/ambientes/{ambiente}', [AmbienteController::class, 'update'])->name('ambientes.update');
Route::delete('/ambientes/{ambiente}', [AmbienteController::class, 'destroy'])->name('ambientes.destroy');
Route::post('/importar-ambientes', [AmbienteController::class, 'importar']);
Route::get('/enviar-correo', [CorreoController::class, 'index']);
Route::post('/enviar-correo-notificacion', [CorreoController::class, 'notificarCambioReglas']);
Route::post('/agregar-regla', [AmbienteController::class, 'addRule']);
Route::get('/reglas', [AmbienteController::class, 'getRules']);
Route::post('/ambientes-filtrar', [AmbienteController::class, 'filtrar']);


Route::post('/ambientes/obtener-id-por-nombre', [AmbienteController::class, 'obtenerIdPorNombre'])->name('ambientes.obtenerIdPorNombre');


//Rutas de las solicitudes

Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
Route::get('/solicitudes/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
Route::delete('/solicitudes/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');




Route::get('/docentes/{idDocente}/materias', [MateriaDocenteController::class, 'obtenerMateriasPorIdDocente']);
