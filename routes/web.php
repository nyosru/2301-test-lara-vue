<?php

use App\Http\Controllers\UserController;
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

// что внутри только для авторизованных
Route::middleware('auth')->group(function () {
    Route::get('page1', function () {
        return view('page1');
    });
});

Auth::routes();

// первая страничка и любой другой неопределённый путь
Route::fallback(function () {
    return view('welcome');
});