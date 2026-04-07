<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomHelloController;

Route::get('/api/custom/hello', CustomHelloController::class);