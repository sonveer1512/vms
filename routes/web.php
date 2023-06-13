<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Cookie;
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
    return view('form');
});

Route::post('/get_state', [IndexController::class, 'get_state']);
Route::post('/get_city', [IndexController::class, 'get_city']);
Route::post('/add_visitors', [IndexController::class, 'add_visitors']);
Route::get('/thank_you/{any}', [IndexController::class, 'thank_you']);

Route::group(['prefix' => '/admin'], function () {
    Route::get('', [AdminController::class, 'index']);
    Route::post('/login', [AdminController::class, 'login']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => '/admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
    });
    Route::group(['prefix' => '/admin'], function () {
        Route::get('user_list', [UserController::class, 'list']);
        Route::post('delete', [UserController::class, 'delete']);
        Route::post('filter', [UserController::class, 'filter']);
    });
});

Route::get('/admin/logout', function () {
    Cookie::queue('login_email', '', time() + 60 * 60 * 24 * 100);
    Cookie::queue('login_pass', '', time() + 60 * 60 * 24 * 100);
    session()->flush();
    return redirect('/admin');
});
