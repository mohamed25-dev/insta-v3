<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    private $post;
    public $postId;
    public $isLiked;
    public $likeCount;

    public function mount ($postId) 
    {
        $this->post = Post::find($postId);

        if ($this->post != null && auth()->user() != null) {
            $this->isLiked = $this->post->likedByUser(auth()->user());
        } 

        $this->likeCount = $this->post->likedByUsers()->count();
    }

    public function toggleLike ($postId) 
    {
        $this->post = Post::find($postId);

        if ($this->post != null && auth()->user() != null) {
            $this->post->likedByUsers()->toggle(auth()->user());
            $this->isLiked = $this->post->likedByUser(auth()->user());

        } else {
            redirect(route('login'));
        }

        $this->likeCount = $this->post->likedByUsers()->count();

    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
