<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResourceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// The Home Page - Shows your Library UI
Route::get('/', [ResourceController::class, 'index'])->name('library');

// Resource Library (Renamed from /resources to /library to match sidebar)
Route::get('/library', [ResourceController::class, 'index'])->name('resources.index');

// Upload Page
Route::get('/library/upload', [ResourceController::class, 'create'])->name('resources.create');
Route::post('/library/upload', [ResourceController::class, 'store'])->name('resources.store');

// Flashcard Creation Page
Route::get('/flashcards', function () {
    return view('flashcards.create');
})->name('flashcards.create');

// My Uploads Page
Route::get('/my-uploads', [ResourceController::class, 'myUploads'])
    ->name('resources.my-uploads')
    ->middleware('auth');

// Add this to fix the "Delete" button in My Uploads
Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy')->middleware('auth');

// Make sure your My Uploads route is exactly like this:
Route::get('/my-uploads', [ResourceController::class, 'myUploads'])->name('resources.my-uploads')->middleware('auth');

// Admin Dashboard (Added for your presentation)
Route::get('/admin', function () {
    return view('admin.dashboard'); // This points to resources/views/admin/dashboard.blade.php
})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';