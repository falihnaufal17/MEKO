<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Web Route
Route::get('/admin/dashboard', [DashboardController::class, 'dashboardView']);

Route::get('/admin/login', [EmployeeController::class, 'loginView']);
Route::get('/admin/employee', [EmployeeController::class, 'employeeView']);

Route::get('/admin/menu', [MenuController::class, 'menuView']);

Route::get('/admin/table', [TableController::class, 'tableView']);

// Client Web Route