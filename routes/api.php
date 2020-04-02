<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api\v1')->group(function () {
    Route::prefix('v1/')->group(function () {
        Route::apiResource('administrador', 'AdministradorController');
        Route::apiResource('cliente', 'ClienteController');
        Route::apiResource('combo', 'ComboController');
        Route::apiResource('usuarios/historial', 'HistorialUsuarioController');
        Route::apiResource('menu', 'MenuController');
        Route::apiResource('reserva', 'ReservaController');
        Route::apiResource('sugerencia', 'SugerenciaController');
        Route::apiResource('restaurante', 'RestauranteController');
        Route::apiResource('reporte','ReporteController');
        Route::apiResource('calificacion','CalificacionController');
        Route::apiResource('categoria','CategoriaController');
        Route::apiResource('pedido','PedidoController');
        Route::apiResource('menudia','MenuDiaController');
        Route::apiResource('mesa','MesaController');
    });
});