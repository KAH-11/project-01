<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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

Route::post("login",[SessionController::class,'Login']);
Route::get("logout",[SessionController::class,'Logout'])->middleware('auth:sanctum');
Route::resource(name:'users',controller:UserController::class)->middleware(['auth:sanctum','role:super-admin']);
Route::resource(name:'products',controller:ProductController::class)->middleware(['auth:sanctum']);
Route::resource(name:'categories',controller:CategoryController::class)->middleware(['auth:sanctum']);