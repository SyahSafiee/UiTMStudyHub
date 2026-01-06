<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import your Controllers here
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\FlashcardDeckController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
// Anyone can browse approved resources without logging in
Route::get('/resources', [ResourceController::class, 'index']);
Route::get('/resources/{resources_id}', [ResourceController::class, 'show']);


/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Login)
|--------------------------------------------------------------------------
| The 'auth:sanctum' middleware ensures only users with a valid
| token (logged in) can access these routes.
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Check current logged-in user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- Resource Management (Students) ---
    Route::post('/resources', [ResourceController::class, 'store']); // Upload
    Route::delete('/resources/{resources_id}', [ResourceController::class, 'destroy']); // Delete own
    
    // --- Flashcard Management (Students) ---
    Route::get('/flashcard-decks', [FlashcardDeckController::class, 'index']);
    Route::post('/flashcard-decks', [FlashcardDeckController::class, 'store']);
    Route::get('/flashcard-decks/{deck_id}', [FlashcardDeckController::class, 'show']);

    // --- Admin Only Actions ---
    // These should ideally use your AdminMiddleware later
    Route::prefix('admin')->group(function () {
        Route::post('/resources/{resource}/approve', [AdminController::class, 'approveResource']);
        Route::get('/users', [AdminController::class, 'viewUserList']);
    });
});