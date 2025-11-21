<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * List all users with lazy loading for performance.
     */
    public function index(): JsonResponse
    {
        $users = User::query()
            ->select(['id', 'name', 'email', 'created_at'])
            ->lazy(1000)
            ->map(fn($user) => $user->only(['id', 'name', 'email', 'created_at']))
            ->values();

        return response()->json($users);
    }
}