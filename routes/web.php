<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Custcontroller;

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


Route::get("/", [Custcontroller::class, 'home']);
Route::get("/selectyouraccount", [Custcontroller::class, 'selectaccount']);
Route::get("/dashboard", [Custcontroller::class, 'transfer']);
