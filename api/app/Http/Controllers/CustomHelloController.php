<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CustomHelloController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'message' => 'Fleetbase custom API is working',
            'status' => 'ok',
        ]);
    }
}