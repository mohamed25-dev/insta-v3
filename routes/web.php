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

Route::get('/followers', function () {
    $user = auth()->user();
    $followers = $user->followers()->get();

    return view('followers', compact(['user', 'followers']));
})->name('followers')->middleware('auth:sanctum');

Route::get('/following', function () {
    $user = auth()->user();
    $following = $user->follows()->get();

    return view('following', compact(['user', 'following']));
})->name('following')->middleware('auth:sanctum');

Route::get('/inbox', function () {
    $user = auth()->user();

    $pendingFollowingReq = $user->pendingFollowingReq();
    $pendingFollowReq = $user->pendingFollowReq();

    return view('inbox', compact('user', 'pendingFollowingReq', 'pendingFollowReq'));
})->name('inbox')->middleware('auth:sanctum');

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

