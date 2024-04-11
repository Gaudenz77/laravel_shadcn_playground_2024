<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\MessageController;

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    
    Route::get('/singlestory/{message}', [MessageController::class, 'showSingleStory'])->name('singlestory.show');
    
});


Route::get('/', function () {
    return Inertia::render('PinBoard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Moved the '/pinboard' route outside of the 'auth' middleware group
/* Route::get('/pinboard', function () {
    return Inertia::render('Pinboard');
})->name('pinboard'); */

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/test', function () {
        return Inertia::render('TestPage', [
            'authId' => auth()->id() // Pass the authenticated user's ID
        ]);
    })->name('test');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/singlestory', function () {
        return Inertia::render('SingleStory', [
            'authId' => auth()->id() // Pass the authenticated user's ID
        ]);
    })->name('singlestory');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


