<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;

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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get("logout",[SessionController::class,'Logout']);

    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource(name:'users',controller:UserController::class);
        Route::resource(name:'products',controller:ProductController::class);
        Route::resource(name:'categories',controller:CategoryController::class);
        Route::get("export-products",[ExportController::class,'export']);
        Route::post("import-products",[ImportController::class,'import']);
    });

});