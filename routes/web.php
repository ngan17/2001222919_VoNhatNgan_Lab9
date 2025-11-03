<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('articles', ArticleController::class)->only(['index','show']);
// Cần đăng nhập
Route::middleware('auth')->group(function () {
Route::get('/articles/create', [ArticleController::class, 'create'])
->name('articles.create')
->middleware('can:create,App\Models\Article');
Route::post('/articles', [ArticleController::class, 'store'])
->name('articles.store')
->middleware('can:create,App\Models\Article');
Route::get('/articles/{article}/edit', [ArticleController::class,
'edit'])
->name('articles.edit')
->middleware('can:update,article');

Route::put('/articles/{article}', [ArticleController::class, 'update'])
->name('articles.update')
->middleware('can:update,article');
Route::delete('/articles/{article}', [ArticleController::class,
'destroy'])
->name('articles.destroy')
->middleware('can:delete,article');
});
require __DIR__.'/auth.php';
