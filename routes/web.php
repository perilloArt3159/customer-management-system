<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController; 
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController; 

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

Route::prefix('/') ->group(
    function () 
    {
        Route::get('',                              [HomeController::class,                      'index'])->name('home');
        Route::get('/login',                        [AuthController::class,                      'login'])->name('login');
    }
);

Route::prefix('/customers')->group(
    function ()
    {
        Route::get('',                              [CustomerController::class,                  'index'])->name('customers.index');
    }
); 
