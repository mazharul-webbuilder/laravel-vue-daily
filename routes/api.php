<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\TaskController;use App\Http\Controllers\Api\V1\CompletedTaskController;


Route::prefix('v1')->group(function (){
    Route::apiResource('/tasks', TaskController::class);
    Route::patch('tasks/{task}/completed', CompletedTaskController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

