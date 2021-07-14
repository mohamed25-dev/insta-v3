<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_path',
        'post_caption'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    public function likedByUsers () {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function likedByUser (User $user) {
        return (bool) DB::table('likes')
        ->where('post_id', $this->id)
        ->where('user_id', $user->id)
        ->count();
    }
}
