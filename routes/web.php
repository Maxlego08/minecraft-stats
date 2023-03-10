<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ServerController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/compare', [ServerController::class, 'compare'])->name('compare');
Route::post('/compare', [ServerController::class, 'globalStats'])->name('compares');
Route::get('/{name}.{server}', [ServerController::class, 'index'])->name('server');
Route::prefix('/stats/{server}/')->name('stats.')->group(function () {
    Route::post('/global/{days}', [ServerController::class, 'stats'])->name('global');
});
