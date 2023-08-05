<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/block', 'App\Http\Controllers\HeaderController@Index');
Route::get('/block/{hash}', 'App\Http\Controllers\HeaderController@Detail');
Route::get('/transaction', 'App\Http\Controllers\TransactionController@Index');
Route::get('/transaction/{hash}', 'App\Http\Controllers\TransactionController@Transaction');
