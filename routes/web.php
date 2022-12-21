<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\CategoryController;

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

Route::get('/admin/login', [AuthController::class, 'showlogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'postlogin'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::group(['prefix'=>'admin', 'middleware' => ['AdminAuth']], function(){
    Route::get('/',[AdminController::class, 'home']);
    Route::resource('/category', CategoryController::class);
    Route::resource('/watch', WatchController::class);
});


