<div class="self-center">
    <button 
        wire:model="accept-follow" 
        wire:click="toggleAccept({{$profileId}})"
        class="text-blue-500 font-semibold hover:text-blue-400">
    
        {{$status}}
    
    </button>
</div>
