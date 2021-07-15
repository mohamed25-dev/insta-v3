<div>
    <input wire:model="search" wire:keydown.debounce.1000ms="findProfile('{{ $search }}')" type="text"
        placeholder="Search" class="border border-gray-300 border-solid text-center p-0">

    @if ($results != null)
        <ul class="absolute mt-2 w-auto bg-white p-1 shadow-lg border border-gray-500 border-solid z-10">
            @foreach ($results as $profile)

                <li class="flex flex-row items-center justify-between my-1 ">
                    <a class="font-bold text-blue-500 hover:underline" href="/{{ $profile['username'] }}">
                        <img src="{{ $profile['profile_photo_url'] }}" alt="{{ $profile['username'] }}"
                            class="rounded-full h-10 w-10 me-24">
                    </a>
                    <span>
                        <a class="font-bold text-blue-500 hover:underline" href="/{{ $profile['username'] }}">
                            {{ $profile['username'] }}</a>
                    </span>
                </li>
                @if (!$loop->last)
                    <hr class="h-2">
                @endif
            @endforeach
        </ul>
    @endif

</div>
