<?php

use App\Http\Controllers\Area\CalendarController;
use App\Http\Controllers\Area\ClientController;
use App\Http\Controllers\Area\DashboardController;
use App\Http\Controllers\Area\TaskController;
use App\Http\Controllers\Area\WorkerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Area\ProfilController;
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

Route::middleware(['guest'])->group(
    function () {
        Route::get('/', [LoginController::class, 'index'])->name('login');
        Route::post('/auth', [LoginController::class, 'auth']);
    }
);


Route::group(['middleware' => ['auth', 'preventBackHistory']], function () {

    Route::group(['middleware' => ['roleCheck:Admin,Worker']], function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/client', [ClientController::class, 'index']);
        Route::get('/client/list', [ClientController::class, 'list']);
        Route::get('/client/search', [ClientController::class, 'search']);
        Route::get('/client/detail/{id}', [ClientController::class, 'detail']);
        Route::post('/client/add', [ClientController::class, 'add']);
        Route::post('/client/edit', [ClientController::class, 'edit']);
        Route::post('/client/delete', [ClientController::class, 'delete']);

        Route::get('/worker', [WorkerController::class, 'index']);
        Route::get('/worker/search', [WorkerController::class, 'search']);
        Route::get('/worker/list-active', [WorkerController::class, 'listActive']);
        Route::get('/worker/list-delete', [WorkerController::class, 'listDelete']);
        Route::get('/worker/detail/{id}', [WorkerController::class, 'detail']);
        Route::post('/worker/add', [WorkerController::class, 'add']);
        Route::post('/worker/edit', [WorkerController::class, 'edit']);
        Route::post('/worker/delete', [WorkerController::class, 'delete']);

        Route::get('/task', [TaskController::class, 'index']);
        Route::get('/task/get-by-date', [TaskController::class, 'getByDate']);
        Route::get('/task/export', [TaskController::class, 'export']);
        Route::get('/task/config', [TaskController::class, 'config']);
        Route::get('/task/list', [TaskController::class, 'list']);
        Route::get('/task/detail/{id}', [TaskController::class, 'detail']);
        Route::post('/task/add', [TaskController::class, 'add']);
        Route::post('/task/edit', [TaskController::class, 'edit']);
        Route::post('/task/edit-pay', [TaskController::class, 'editPay']);
        Route::post('/task/edit-status', [TaskController::class, 'editStatus']);
        Route::post('/task/delete', [TaskController::class, 'delete']);

        Route::post('/task/add-file', [TaskController::class, 'addFile']);
        Route::post('/task/edit-file', [TaskController::class, 'editFile']);
        Route::post('/task/delete-file', [TaskController::class, 'deleteFile']);

        Route::get('/calendar', [CalendarController::class, 'index']);

        Route::get('/profil', [ProfilController::class, 'index']);
        Route::post('/profil/edit', [ProfilController::class, 'edit']);
    });
});
