<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/menu/lists', [MenuController::class, 'index']);
Route::post('/menu/create', [MenuController::class, 'create']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router){
    Route::post('/employee/refresh', [EmployeeController::class, 'refresh']);
    Route::post('/employee/create', [EmployeeController::class, 'store']);
    Route::post('/employee/login', [EmployeeController::class, 'login']);
    Route::get('/employee/list', [EmployeeController::class, 'index']);
    Route::get('/employee/{id}', [EmployeeController::class, 'detail']);
    Route::post('/employee/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'delete']);
});