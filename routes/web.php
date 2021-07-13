<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect("/" . auth()->user()->username);
})->name('dashboard');

Route::get('{username}', function ($username) {
    $profile = User::where('username', $username)->first();
    if ($profile == null) {
        abort(404);
    }

    $posts = $profile->posts()->get();

    return view('profile', compact('profile', 'posts'));
})->name('user_profile')->middleware('auth');

Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);

