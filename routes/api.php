<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// Route::group(['middleware' => 'auth:sanctum'] , function(){
//     Route::get("logout",[SessionController::class,'Logout']);
//     Route::resource(name:'users',controller:UserController::class)->middleware(['role:super-admin']);
//     Route::resource(name:'products',controller:ProductController::class);
//     Route::resource(name:'categories',controller:CategoryController::class);
// });

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get("logout",[SessionController::class,'Logout']);
    Route::resource(name:'products',controller:ProductController::class);
    Route::resource(name:'categories',controller:CategoryController::class);

    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource(name:'users',controller:UserController::class);
    });

});