<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');

Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');

Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');

Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');


Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');


Route::get('/users{user}/comments', [CommentController::class, 'showUserComments'])->name('users.comments');

Route::get('/users/{user}/topics', [TopicController::class, 'showUserTopics'])->name('users.topics');

Route::get('/users/{user}/articles', [ArticleController::class, 'showUserArticles'])->name('users.articles');

Route::get('/users/{user}/profile', [ProfileController::class, 'show'])->name('profiles.show');

Route::post('/comments', [CommentController::class, 'store'])->middleware(['auth'])->name('comments.store');

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
