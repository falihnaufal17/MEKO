<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TableController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'menu'
], function(){
    Route::get('/list', [MenuController::class, 'index']);
    Route::post('/create', [MenuController::class, 'store']);
    Route::get('/categories', [MenuController::class, 'categories']);
    Route::delete('/{id}', [MenuController::class, 'delete']);
    Route::get('/{id}', [MenuController::class, 'detail']);
    Route::post('/approve/{id}', [MenuController::class, 'approveMenu']);
    Route::post('/reject/{id}', [MenuController::class, 'rejectMenu']);
    Route::post('/change-stock/{id}', [MenuController::class, 'changeStatusStock']);
    Route::post('/{id}', [MenuController::class, 'update']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/employee'
], function(){
    Route::post('/refresh', [EmployeeController::class, 'refresh']);
    Route::post('/create', [EmployeeController::class, 'store']);
    Route::post('/login', [EmployeeController::class, 'login']);
    Route::get('/list', [EmployeeController::class, 'index']);
    Route::get('/{id}', [EmployeeController::class, 'detail']);
    Route::post('/{id}', [EmployeeController::class, 'update']);
    Route::delete('/{id}', [EmployeeController::class, 'delete']);
});

Route::group([
    // 'middleware' => 'api',
    'prefix' => 'table'
], function(){
    Route::get('/', [TableController::class, 'index']);
    Route::post('/add', [TableController::class, 'store']);
    Route::delete('/{id}', [TableController::class, 'delete']);
    Route::post('/{id}', [TableController::class, 'update']);
    Route::get('/{id}', [TableController::class, 'detail']);
});