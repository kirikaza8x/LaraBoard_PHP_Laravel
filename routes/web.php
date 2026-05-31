<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// All routes inside this group require the user to be logged in
Route::middleware('auth')->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 1. NESTED RESOURCE FIRST (Projects inside Workspaces)
    Route::resource('workspaces.projects', ProjectController::class);

    // 2. STANDARD RESOURCE SECOND (Workspaces)
    Route::resource('workspaces', WorkspaceController::class);
});

require __DIR__.'/auth.php';