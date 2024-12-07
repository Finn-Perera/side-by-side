<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');

Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');

Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');

Route::get('/topics/{id}', [TopicController::class, 'show'])->name('topics.show');


Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show');

Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');


Route::get('/secret', function() {
    return "secret";
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
