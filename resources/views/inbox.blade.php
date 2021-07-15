<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class="col-start-5 col-span-4">

            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">{{ __('Follow requests:') }}</h3>

            @if ($pendingFollowingReq != null && sizeof($pendingFollowingReq) > 0)
                @foreach ($pendingFollowingReq as $req)
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-row justify-around">
                            <div class="flex flex-row ">
                                <a href="/{{ $req->username }}"><img src="{{ $req->profile_photo_url }}"
                                        alt="avatar" class="rounded-full h-10 w-10 me-3"></a>
                                <div class="flex flex-col self-center">
                                    <a href="/{{ $req->username }}"
                                        class="text-base hover:underline whitespace-nowrap">{{ $req->username }}</a>
                                    <h3 class="text-sm text-gray-500 truncate whitespace-nowrap"
                                        style="max-width: 25ch">{{ $req->bio }}</h3>
                                </div>
                            </div>
                            @if ($user->status == 'private')
                                @livewire('accept-follow', ['profileId' => $req->id],key($req->username))
                            @endif
                            @livewire('follow-button', ['profileId' => $req->id],key($req->id))
                        </div>
                    </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{ $pendingFollowingReq->links() }}
                </div>
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">{{ __('Nothing to show right now!') }}</p>
                </div>
            @endif

            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">{{ __('Pending sent requests:') }}
            </h3>

            @if ($pendingFollowReq != null && sizeof($pendingFollowReq) > 0)
                @foreach ($pendingFollowReq as $req)
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-row justify-around">
                            <div class="flex flex-row ">
                                <a href="/{{ $req->username }}"><img src="{{ $req->profile_photo_url }}"
                                        alt="avatar" class="rounded-full h-10 w-10 me-3"></a>
                                <div class="flex flex-col self-center">
                                    <a href="/{{ $req->username }}"
                                        class="text-base hover:underline whitespace-nowrap">{{ $req->username }}</a>
                                    <h3 class="text-sm text-gray-500 truncate whitespace-nowrap"
                                        style="max-width: 25ch">{{ $req->bio }}</h3>
                                </div>
                            </div>
                            @livewire('follow-button',['profileId' => $req->id],key($req->id))
                        </div>
                    </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{ $pendingFollowReq->links() }}
                </div>
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">{{ __('Nothing to show right now!') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
