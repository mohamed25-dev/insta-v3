<x-app-layout>
    <x-slot name="header">
        <header>
            <div class="grid grid-cols-5 gap-4">
                <div class="col-start-2 col-span-1 flex justify-center  w-auto mt-5">
                    <img class="w-40 h-40 rounded-full" src="{{ $profile->profile_photo_url }}"
                        alt="{{ $profile->username }}">
                </div>

                <div class="col-start-3 col-span-2 flex justify-start items-center w-auto m-0 ">
                    <div class="grid grid-rows-2   ">
                        <div class="flex flex-row items-center">
                            <h1 class="font-light text-3xl me-14">{{ $profile->username }}</h1>
                            @if (Auth::user() != null && Auth::user()->name == $profile->name)
                                <a href="{{ route('profile.show') }}"
                                    class="border border-solid border-gray-300 rounded-md py-0 px-5 me-16 whitespace-nowrap ">
                                    {{ __('Edit Profile') }}</a>
                                <a href="/posts/create">
                                    <x-jet-button class="ms-8 leading-none whitespace-nowrap">
                                        {{ __('Add Post') }}
                                    </x-jet-button>
                                </a>
                            @else
                                {{-- @livewire('follow-button',['profile_id' => $profile->id ], key($profile->id)) --}}
                            @endif
                        </div>
                        <div>
                            <ul class="flex flex-row mb-5">
                                <li class="me-10 cursor-pointer"><span
                                        class="font-semibold">{{ $profile->posts->count() }}</span>
                                    {{ __('posts') }}
                                </li>
                                {{-- <li class="me-10"><a href="{{ route('followers') }}"> --}}
                                <li class="me-10"><a href="#">

                                        <span class="font-semibold">
                                            {{-- {{ $profile->followers()->count() }} --}}
                                            3
                                        </span> {{ __('followers') }}</a></li>
                                {{-- <li class="me-10"><a href="{{ route('following') }}"> --}}
                                <li class="me-10"><a href="#">
                                        <span class="font-semibold">
                                            5
                                            {{-- {{ $profile->follows()->count() }} --}}
                                        </span> {{ __('following') }}</a></li>
                            </ul>
                            <p class="mb-1 font-black">{{ $profile->name }}</p>
                            <p>{{ $profile->bio }}</p>
                            <p class="text-blue-500"><a href="{{ $profile->url }}">{{ $profile->url }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </x-slot>

    <div class="max-w-4xl my-0 mx-auto">
        <hr class="mb-10">
        @if ($profile->status == 'public')
            <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
                @foreach ($posts as $post)
                    <div class="post">
                        <a href="/posts/{{ $post->id }}" class="w-full h-full">
                            <img src="/storage/{{ $post->image_path }}" class="w-full h-full object-cover">
                            <div class="post-info">
                                <ul>
                                    <li class="inline-block font-semibold me-7">
                                        <span class="absolute h-1 w-1 overflow-hidden">{{ __('Likes:') }}</span>
                                        <i class="fas fa-heart" aria-hidden="true"></i>
                                        {{ $post->likedByUsers->Count() }}
                                    </li>
                                    <li class="inline-block font-semibold">
                                        <span class="absolute h-1 w-1 overflow-hidden">{{ __('Comments:') }}</span>
                                        <i class="fas fa-comment" aria-hidden="true"></i>
                                        {{ $post->comments()->count() }}
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            @can('view-profile', $profile)
                <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
                    @foreach ($posts as $post)
                        <div class="post">
                            <a href="/posts/{{ $post->id }}" class="w-full h-full">
                                <img src="/storage/{{ $post->image_path }}" class="w-full h-full object-cover">
                                <div class="post-info">
                                    <ul>
                                        <li class="inline-block font-semibold me-7">
                                            <span class="absolute h-1 w-1 overflow-hidden">{{ __('Likes:') }}</span>
                                            <i class="fas fa-heart" aria-hidden="true"></i>
                                            {{ $post->likedByUsers->Count() }}
                                        </li>
                                        <li class="inline-block font-semibold">
                                            <span class="absolute h-1 w-1 overflow-hidden">{{ __('Comments:') }}</span>
                                            <i class="fas fa-comment" aria-hidden="true"></i>
                                            {{ $post->comments()->count() }}
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-span-3 mt-10">
                        {{ $posts->links() }}
                    </div>
                </div>
            @else
                <div>
                    <h1 class="text-center">{{ __('This account is private') }}</h1>
                    <p class="text-center">{{ __('Follow to see their posts') }}</p>
                </div>
            @endcan
        @endif
    </div>
</x-app-layout>
