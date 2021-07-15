<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified', 'lang'])->group(function () {
    Route::get('/followers', function () {
        $user = auth()->user();
        $followers = $user->followers()->paginate(12);

        return view('followers', compact(['user', 'followers']));
    })->name('followers');

    Route::get('/explore', function () {
        $user = auth()->user();
        $posts = $user->explore();

        return view('explore', compact(['user', 'posts']));
    })->name('explore');

    Route::get('/following', function () {
        $user = auth()->user();
        $following = $user->follows()->paginate(12);

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

    $posts = $profile->posts()->paginate(9);

    return view('profile', compact('profile', 'posts'));
})->name('user_profile')->middleware('lang');

Route::resource('posts', PostController::class)->middleware('lang');

Route::get('/setlang/{lang}', function ($lang) {
    if ($lang == 'ar' || $lang == 'en') {
        session(['lang' => $lang]);
    } else {
        abort(404);
    }

    return redirect()->back();
});