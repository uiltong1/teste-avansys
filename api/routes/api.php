<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OperadoraController;
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


Route::get('operadoras', [OperadoraController::class, 'index']);
Route::get('operadoras/{id}/edit', [OperadoraController::class, 'edit']);
Route::post('operadoras', [OperadoraController::class, 'store']);
Route::put('operadoras/{id}', [OperadoraController::class, 'update']);
Route::delete('operadoras', [OperadoraController::class, 'destroy']);
Route::get('operadoras_search', [OperadoraController::class, 'search']);