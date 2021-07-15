<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/followers', function () {
        $user = auth()->user();
        $followers = $user->followers()->get();

        return view('followers', compact(['user', 'followers']));
    })->name('followers');

    Route::get('/explore', function () {
        $user = auth()->user();
        $posts = $user->explore();

        return view('explore', compact(['user', 'posts']));
    })->name('explore');

    Route::get('/following', function () {
        $user = auth()->user();
        $following = $user->follows()->get();

        return view('following', compact(['user', 'following']));
    })->name('following');

    Route::get('/inbox', function () {
        $user = auth()->user();

        $pendingFollowingReq = $user->pendingFollowingReq();
        $pendingFollowReq = $user->pendingFollowReq();

        return view('inbox', compact('user', 'pendingFollowingReq', 'pendingFollowReq'));
    })->name('inbox');

    Route::get('/home', function () {
        $posts = auth()->user()->home();
        $profile = auth()->user();

        $iFollow = auth()->user()->iFollow();
        $toFollow = auth()->user()->toFollow()->take(3);

        return view('home', compact('posts', 'profile', 'iFollow', 'toFollow'));
    })->name('home');

    Route::get('/', function () {
        return redirect("/" . auth()->user()->username);
    });

    Route::resource('comments', CommentController::class);
});




Route::get('{username}', function ($username) {
    $profile = User::where('username', $username)->first();
    if ($profile == null) {
        abort(404);
    }

    $posts = $profile->posts()->get();

    return view('profile', compact('profile', 'posts'));
});

Route::resource('posts', PostController::class);
