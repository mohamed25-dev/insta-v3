<div class="flex flex-col items-start ps-4 pb-1">
    <div class="flex flex-row items-center">
        <button class="text-2xl me-3 focus:outline-none" wire:model="like-button"
            wire:click="ToggleLike({{ $postId }})">
            <i class="{{ $isLiked ? 'fas text-red-500' : 'far' }} fa-heart"></i>
        </button>

        <button class="text-2xl me-3 focus:outline-none"
            onClick="document.getElementById('comment{{ $postId }}').focus()">
            <i class="far fa-comment"></i>
        </button>

        <button class="text-2xl me-3 focus:outline-none" 
            onClick="copyToClipboard({{ $postId }})"
            id="{{ $postId }}" value="{{ url('') }}/posts/{{ $postId }}">
            <i class="far fa-share-square"></i>
        </button>
    </div>

    <span>{{ __('Liked by') }} {{ $likeCount }} </span>
</div>
