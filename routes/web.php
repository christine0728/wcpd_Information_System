<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned
| to the "web" middleware group, which includes middleware like
| web. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('team')->group(function(){
    Route::get('/login', [HomeController::class, 'login_view'])->name('login_form');
    Route::post('/login_account', [HomeController::class, 'login'])->name('logging_in');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('team.dashboard');
});

Route::prefix('superadmin')->group(function(){
    Route::post('/add_teamaccount', [SuperAdminController::class, 'add'])->name('superadmin.add_teamaccount'); 
});
