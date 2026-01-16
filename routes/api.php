<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function(){
    Route::get('getAllTask',[TaskController::class,'index']);
    Route::get('getById/{id}',[TaskController::class,'show']);
    Route::post('store',[TaskController::class,'store']);
    Route::put('update/{id}',[TaskController::class,'update']);
    Route::delete('destroy/{id}',[TaskController::class,'destroy']);
    Route::delete('forceDeleted/{id}',[TaskController::class,'forceDeletedTask']);
    Route::post('restoreTask/{id}',[TaskController::class,'restoreTask']);
});
