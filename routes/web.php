<?php

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServerStatusController;

// Wave routes
Wave::routes();

// Server Status Route
Route::get('/server-status', [ServerStatusController::class, 'index'])->name('server.status');