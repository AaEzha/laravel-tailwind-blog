<?php

use App\Http\Controllers\Reza\BlogController;
use App\Http\Controllers\Reza\MyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class, 'index'])->name('index');
Route::get('/read/{blog:slug}', [BlogController::class, 'show'])->name('blog');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('categories', [MyController::class, 'categories'])->name('categories');
    Route::post('categories', [MyController::class, 'categories']);
    Route::get('articles', [MyController::class, 'articles'])->name('articles');
    Route::post('articles', [MyController::class, 'articles']);
});
