<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MasterController;
// use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user_id}', [UserController::class, 'show']);
Route::put('/users/{user_id}', [UserController::class, 'update']);
Route::delete('/users/{user_id}', [UserController::class, 'destroy']);
Route::get('/roles', [MasterController::class, 'get_roles']);
Route::get('/items/{user_id}', [MasterController::class, 'get_items'] );
Route::get('/item_detail/{item_id}', [MasterController::class, 'get_item_detail'] );
