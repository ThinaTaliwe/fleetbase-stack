<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SwaggerTestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/health",
     *     operationId="healthCheck",
     *     tags={"System"},
     *     summary="Health check endpoint",
     *     @OA\Response(
     *         response=200,
     *         description="Health check response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="healthy")
     *         )
     *     )
     * )
     */
    public function health(): JsonResponse
    {
        return response()->json(['status' => 'healthy']);
    }
}