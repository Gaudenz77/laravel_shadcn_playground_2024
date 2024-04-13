<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\MessageController;

/* Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    
    Route::get('/singlestory/{message}', [MessageController::class, 'showSingleStory'])->name('singlestory.show');
    
});
 */

 Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
 Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
 Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
 Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
 Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
 Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

 Route::get('/singlestory/{message}', [MessageController::class, 'showSingleStory'])->name('singlestory.show');
 
 // Route for non-authenticated users to fetch messages
 Route::get('/public/messages', [MessageController::class, 'publicIndex'])->name('messages.publicIndex');
 

Route::get('/', function () {
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

Route::middleware(['auth'])->group(function () {
    Route::get('/test', function () {
        return Inertia::render('TestPage', [
            'authId' => auth()->id() // Pass the authenticated user's ID
        ]);
    })->name('test');
});



Route::get('/twitter-oembed', function () {
    $response = Http::get('https://publish.twitter.com/oembed?url=https://twitter.com/Krakatoom1?ref_src=twsrc%5Etfw');

    return $response->body();
});

/* Route::middleware(['auth'])->group(function () {
    Route::get('/pinboard', function () {
        return Inertia::render('PinBoard', [
            'authId' => auth()->id() // Pass the authenticated user's ID
        ]);
    })->name('pinboard');
});
 */

 Route::get('/pinboard', function () {
    return Inertia::render('PinBoard', [
        'auth' => [
            'user' => auth()->user(), // Access the authenticated user directly
        ],
    ]);
})->name('pinboard');


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


