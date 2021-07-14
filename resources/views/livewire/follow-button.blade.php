<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <button class="bg-blue-500 rounded-lg shadow px-2 py-1 text-white"
            wire:model="follow-button"
            wire:click="toggleFollowing({{$profileId}})">
        {{$followText}}
    </button>
</div>
