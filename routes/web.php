<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::resource('posts',PostController::class);
Route::post('posts/store2',[PostController::class,'store2'])->name('posts.store2');

Route::get('comments',[CommentController::class,'index'])->name('comments.index');
Route::post('comments',[CommentController::class,'store'])->name('comments.store');
