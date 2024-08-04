<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskMangement;
use Illuminate\Support\Facades\Route;

// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for the dashboard, requires authentication and email verification
Route::get('/dashboard', [TaskMangement::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Grouped routes that require authentication
Route::middleware('auth')->group(function () {
    // Routes for profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for task management
    Route::post('/AddTask', [TaskMangement::class, 'Add'])->name('Task.store');
    Route::get('/CompleteTask/{id}', [TaskMangement::class, 'complete'])->name('Complete.store');
    Route::get('/DeleteTask/{id}', [TaskMangement::class, 'delete'])->name('DeleteTask');
});

// Require the authentication routes
require __DIR__ . '/auth.php';
