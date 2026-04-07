<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

class ApiInfoController extends Controller
{
    public function index()
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->filter(function ($route) {
                return str_contains($route->uri(), 'int/v1/');
            })
            ->map(function ($route) {
                return [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                ];
            })
            ->values()
            ->toArray();

        return response()->json([
            'api_version' => 'v1',
            'base_url' => url('/int/v1'),
            'total_endpoints' => count($routes),
            'endpoints' => $routes,
        ]);
    }
    
    public function health()
    {
        return response()->json([
            'status' => 'healthy',
            'timestamp' => now()->toIso8601String(),
            'service' => 'Fleetbase API',
        ]);
    }
}
