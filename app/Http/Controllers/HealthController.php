<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json(
            [
                'status' => 'ok',
                'timestamp' => now()->toIso8601String(),
            ]
        );
    }
}
