<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes (with session-request handling)
Route::middleware('auth:sanctum')->group(function () {

    // Requests and related sessions (many-to-many)
    Route::apiResource('requests', RequestController::class);

    // Route to handle adding multiple sessions to a request
    Route::post('/requests/{request}/sessions', [RequestController::class, 'attachSessions']);

    // Route to handle removing specific sessions from a request
    Route::delete('/requests/{request}/sessions/{session}', [RequestController::class, 'detachSession']);

    // Other resources
    Route::apiResource('sessions', SessionController::class);
    Route::apiResource('labs', LabController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('approvals', ApprovalController::class);
    Route::apiResource('notifications', NotificationController::class);

    // Get authenticated user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout route
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
