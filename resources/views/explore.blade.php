<x-app-layout>
  <x-slot name="header">
  </x-slot>

  <div class="max-w-4xl my-0 mx-auto">    
      <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-10">  
        
      @foreach ($posts as $post)
      <div class="post">
      <a href="/posts/{{$post->id}}" class="w-full h-full"><img src="/storage/{{$post->image_path}}"
              class="w-full h-full object-cover">
          <div class="post-info">
              <ul>
                  <li class="inline-block font-semibold me-7"><span class="absolute h-1 w-1 overflow-hidden">{{__('Likes:')}}</span><i
                          class="fas fa-heart" aria-hidden="true"></i> {{$post->likedByUsers->Count()}}</li>
                  <li class="inline-block font-semibold"><span class="absolute h-1 w-1 overflow-hidden">{{__('Comments:')}}</span><i
                          class="fas fa-comment" aria-hidden="true"></i> {{$post->comments()->count()}}</li>
              </ul>
          </div>
      </a>
      </div>
      @endforeach
      <div class="col-span-3 mt-10">
          {{ $posts->links() }}
      </div>
      </div>
  </div>
</x-app-layout>