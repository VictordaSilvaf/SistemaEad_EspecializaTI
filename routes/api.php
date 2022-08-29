<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController,
    SupportController,
};
use App\Http\Controllers\Api\Auth\{
    AuthController,
    ResetPasswordController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * AUTH
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Reset password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);

    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
    Route::get('/lessons/{id}', [LessonController::class, 'shiow']);

    Route::get('/supports/my', [SupportController::class, 'mySupports']);
    Route::get('/supports', [SupportController::class, 'index']);
    Route::post('/supports', [SupportController::class, 'store']);

    Route::post('/replies', [ReplySupportController::class, 'createReplies']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
