<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class="col-start-3 col-span-5">

            @forelse ($posts as $post)
                <div class="flex flex-col border border-solid border-gray-300 mb-14 bg-white">
            <div class="flex flex-row p-3 border-b border-solid border-gray-300 items-center">
                <a href="/{{ $post->user->username }}">
                    <img src="{{ $post->user->profile_photo_url }}" alt="avatar"
                        class="rounded-full h-12 w-12 mr-3 ">
                </a>
                <a href="/{{ $post->user->username }}"
                    class="hover:underline">{{ $post->user->username }}</a>
            </div>
            <div>
                <a href="/posts/{{ $post->id }}"><img class="w-full"
                        src="/storage/{{ $post->image_path }}">
                </a>
            </div>
            <div class="flex flex-row items-center mt-2 ml-4">
                @livewire('like-button', ['postId' => $post->id], key($post->id))
            </div>
            <div class="border-b border-solid border-gray-200 ps-4 pb-1">
                <div class="ml-4 mb-2">
                    <a class="font-bold text-base hover:underline"
                        href="/{{ $post->user->username }}">{{ $post->user->username }} </a>
                    <span>{{ $post->post_caption }}</span>
                </div>
                @foreach ($post->comments as $comment)
                    @if ($loop->iteration == 4)
                        @break
                    @endif
                    <div class="col-span-1 ml-3">
                        <img src="{{ $comment->user->profile_photo_url }}" class="rounded-full h-10 w-10 ">
                    </div>

                    <div class="col-span-4 ml-4">
                        <a class="font-bold hover:underline"
                            href="/{{ $comment->user->username }}">{{ $comment->user->username }} </a>
                        <span>{{ $comment->comment }}</span>
                    </div>
                @endforeach

            @if ($post->comments()->count() > 3)
                <a class="font-sm text-gray-700" href="/posts/{{ $post->id }}">{{ __('View all') }}
                    {{ $post->comments()->count() }} {{ __('comments') }}</a>
            @endif
            <div class="text-gray-500 text-xs ml-4">
                {{ $post->created_at->format('M j o') }}
            </div>
        </div>
        <div class="p-4">
            <form action="/comments" method="post" autocomplete="off">
                @csrf
                <div class="flex flex-row items-center justify-between">
                    <input class="w-full outline-none border-none p-0" type="text" id="comment{{ $post->id }}"
                        placeholder="{{ __('Add Comment') }}" name="comment" />
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button class="text-blue-500 font-semibold hover:text-blue-700"
                        type="submit">{{ __('Post') }}</button>
                </div>
            </form>
        </div>
    </div>
    @empty
        <div class="m-10">
            <p class="font-semibold">{{ __('Start your journey, follow your friends!') }}</p>
        </div>
        @endforelse
        <div class="col-span-3 mt-10">
            {{ $posts->links() }}
        </div>
        </div>
        <div class="col-start-8 col-span-3 ml-4">

            <div class="flex flex-row items-center">
                <a href="/{{ $profile->username }}"><img src="{{ $profile->profile_photo_url }}" alt="avatar"
                        class="rounded-full h-12 w-12 mr-3 "></a>
                <div class="flex flex-col">
                    <a href="/{{ $profile->username }}" class="text-base hover:underline">{{ $profile->username }}</a>
                    <h3 class="text-sm text-gray-400 ">{{ $profile->bio }}</h3>
                </div>
            </div>

            <h3 class="mt-4 mb-4 text-gray-500 font-semibold">{{ __(' People you follow:') }}</h3>
            @forelse ($iFollow as $follow)
                <div class="flex flex-col mb-3">
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-row ">
                            <a href="/{{ $follow->username }}"><img src="{{ $follow->profile_photo_url }}"
                                    alt="avatar" class="rounded-full h-10 w-10 mr-3"></a>
                            <div class="flex flex-col self-center">
                                <a href="/{{ $follow->username }}"
                                    class="text-base hover:underline">{{ $follow->username }}</a>
                                <h3 class="text-sm text-gray-500 truncate" style="max-width: 25ch">{{ $follow->bio }}
                                </h3>
                            </div>
                        </div>
                        @livewire('follow-button',['profileId' => $follow->id],key($follower->id))
                    </div>
                </div>
            @empty
                <div class="my-10">
                    <p class="font-semibold">{{ __('Nothing to show right now!') }}</p>
                </div>
            @endforelse

            <h3 class="mt-4 mb-4 text-gray-500 font-semibold"> {{ __('People you may like to follow:') }}</h3>

            @forelse ($toFollow as $follow)
                <div class="flex flex-col mb-3">
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-row ">
                            <a href="/{{ $follow->username }}"><img src="{{ $follow->profile_photo_url }}"
                                    alt="avatar" class="rounded-full h-10 w-10 mr-3"></a>
                            <div class="flex flex-col self-center">
                                <a href="/{{ $follow->username }}"
                                    class="text-base hover:underline">{{ $follow->username }}</a>
                                <h3 class="text-sm text-gray-500 truncate" style="max-width: 25ch">{{ $follow->bio }}
                                </h3>
                            </div>
                        </div>
                        @livewire('follow-button',['profileId' => $follow->id],key($follower->id))
                    </div>
                </div>
            @empty
                <div class="my-10">
                    <p class="font-semibold">{{ __('Nothing to show right now!') }}</p>
                </div>
            @endforelse
        </div>
        </div>
    </x-app-layout>
