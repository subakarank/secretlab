<?php

use App\Http\Controllers\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/object',[OrderController::class, 'store'])->name('create-object');
Route::get('/object/get_all_records', [OrderController::class, 'index'])->name('get-all-objects');
Route::get('/object/{name}', [OrderController::class, 'show'])->name('get-object');


