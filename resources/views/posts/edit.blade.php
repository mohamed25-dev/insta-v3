<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-center">
            
          <h1 class="text-2xl md:text-5xl mt-7"> {{ __('Edit Post') }}</h1>
      </div>
  </x-slot>

  <div class="grid grid-col-5 mt-7">
      <form class="col-start-2 col-span-3 max-w-4xl" method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
  
          <div>
              <x-jet-label value="{{ __('Caption') }}" />
              <x-jet-input class="block mt-1 w-full h-20" type="textarea" name="post_caption" :value="old('post_caption')" value="{{$post->post_caption}}"  autofocus />
          </div>

          <div class="mt-4">
              <x-jet-label value="{{ __('Image') }}" />
              <x-jet-input class="block mt-1 w-full bg-white p-2" type="file" name="image_path" :value="old('image_path')"  value="{{$post->image_path}}"  autofocus />
          </div>
        
              <x-jet-button class="mt-4">
                  {{ __('Publish') }}
              </x-jet-button>
      </form>
  </div>
  
</x-app-layout>