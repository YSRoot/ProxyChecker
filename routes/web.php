<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ProxyListController;
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

Auth::routes();

Route::resource('proxy', ProxyController::class)->only(['index', 'show']);
Route::resource('proxy-lists', ProxyListController::class)->only(['show', 'create', 'store']);

Route::redirect('/', route('proxy-lists.create'));

Route::get('/home', [HomeController::class, 'index'])->name('home');

