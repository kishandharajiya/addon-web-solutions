<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->group(function(){
    Route::post('login',[AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function(){
        Route::get('list', [UserController::class, 'list'])->name('list');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('update', [UserController::class, 'update'])->name('update');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');
    });
    Route::prefix('post')->group(function () {
        Route::post('create', [PostController::class, 'create'])->name('create');
        Route::get('list', [PostController::class, 'list'])->name('list');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('update', [PostController::class, 'update'])->name('update');
        Route::post('delete', [PostController::class, 'delete'])->name('delete');
    }); 
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
