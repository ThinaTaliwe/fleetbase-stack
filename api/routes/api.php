<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomHelloController;


// Swagger documentation test route
Route::get('/health', [\App\Http\Controllers\Api\SwaggerTestController::class, 'health']);

Route::get('/healthTest', fn() => response()->json([
    'status' => 'ok',
]));
// API Info endpoints
Route::get('/api-info', [AppHttpControllersApiApiInfoController::class, 'index']);
Route::get('/health', [AppHttpControllersApiApiInfoController::class, 'health']);

Route::get('/custom/hello', CustomHelloController::class);

