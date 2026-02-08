<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\FlashcardDeckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Tak payah login boleh tengok) ---

// The Home Page - Shows your Library UI
Route::get('/', [ResourceController::class, 'index'])->name('library');

// Resource Library
Route::get('/library', [ResourceController::class, 'index'])->name('resources.index');


// --- PROTECTED ROUTES (Wajib Login) ---
Route::middleware(['auth'])->group(function () {

    // 1. Resource Management (Upload, Manage, View, Download)
    Route::get('/library/upload', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/library/upload', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/my-uploads', [ResourceController::class, 'myUploads'])->name('resources.my-uploads');
    Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');

    // [BARU] Route untuk Download & View File
    Route::get('/resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download');
    Route::get('/resources/{id}/view', [ResourceController::class, 'view'])->name('resources.view');

    // 2. Flashcard Routes (Moved here for security)
    Route::get('/flashcards', [FlashcardDeckController::class, 'index'])->name('flashcards.index');
    Route::get('/flashcards/create', [FlashcardDeckController::class, 'create'])->name('flashcards.create');
    Route::post('/flashcards', [FlashcardDeckController::class, 'store'])->name('flashcards.store');
    Route::get('/flashcards/{id}', [FlashcardDeckController::class, 'show'])->name('flashcards.show');

    // 3. Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // 4. Settings (Password & Delete Account)
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');

    // 5. Admin Dashboard (Admin Only)
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::patch('/resources/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('admin.resources.status');
        Route::get('/resources/{id}/view', [AdminDashboardController::class, 'viewFile'])->name('admin.resources.view');
    });

});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
