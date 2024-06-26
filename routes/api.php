<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
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



Route::post('/token/client', [AccessTokenController::class, 'issueToken'])->middleware(['throttle'])->name('token');
/**
 * Todo: Token client Valida que en el header venga la propiedad Authorization
 * Todo: CheckClientTokenAccess: Capturamos el token y lo decodificamos para obtener el client_id
 * Todo: client: es el middleware que valida el token del cliente este middleware es de la libreria passport

 */
Route::middleware('token_client', 'CheckClientTokenAccess', 'client')->get('/test', function () {
    return response()->json(['foo' => 'bar']);
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);
/**
 * Todo: Listar usuarios con el middleware auth:api
 */
Route::get('/list/users', [UserController::class, 'index'])->middleware('auth:api');

// Route::middleware('user')->prefix('/admin')->group(function () {
// });