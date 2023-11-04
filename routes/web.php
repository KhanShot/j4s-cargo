<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route("login");
});
Route::get('get-logs', [\App\Http\Controllers\CostController::class, 'getLogs']);
Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function (){
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');

    Route::prefix('tracks')->middleware('manager')->group(function (){
        Route::get('/', [\App\Http\Controllers\TracksController::class, 'getTracks'])->name('admin.tracks');
        Route::post('/scan', [\App\Http\Controllers\TracksController::class, 'scan']);
        Route::post('/edit', [\App\Http\Controllers\TracksController::class, 'edit'])->name('admin.tracks.edit');
    });

    Route::prefix('users')->middleware('admin')->group(function (){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
        Route::delete('/delete/{user_id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('admin.users.delete');
    });

    Route::prefix('logs')->middleware('manager')->group(function (){
        Route::get('', [\App\Http\Controllers\CostController::class, 'logs'])->name('admin.logs');
        Route::post('import', [\App\Http\Controllers\CostController::class, 'import'])->name('admin.import');
    });

    Route::prefix('cost')->middleware('admin')->group(function (){
        Route::get('', [\App\Http\Controllers\CostController::class, 'index'])->name('admin.costs');
        Route::post('create', [\App\Http\Controllers\CostController::class, 'create'])->name('admin.costs.create');
    });
});


Route::middleware('auth')->group(function (){
    Route::get('tracks', [\App\Http\Controllers\TracksController::class, 'index'])->name('tracks');
    Route::post('tracks/create', [\App\Http\Controllers\TracksController::class, 'create'])->name('tracks.create');
});
