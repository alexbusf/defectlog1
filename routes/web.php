<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        return redirect()->route('posts.index'); // Redirect to the dashboard if authenticated
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::get('/posts/search', [PostController::class, 'search'])->name('search');
    Route::get('/posts/searchByDate', [PostController::class, 'searchByDate'])->name('searchByDate');
    Route::resource('posts', PostController::class);
    Route::get('/categories/{category}', [PostController::class, 'postsByCategory'])->name('postsByCategory');
    Route::get('/authors/{user}', [PostController::class, 'postsByUser'])->name('postsByUser');
});

require __DIR__.'/auth.php';
