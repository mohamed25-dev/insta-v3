<x-app-layout>
  <x-slot name="header">
  </x-slot>

  <div class="grid grid-cols-5 mt-7 gap-4 ">
      <div class="col-start-2 col-span-3 border border-solid border-gray-300">
          <div class="grid grid-cols-5">
              <div class="col-span-3">
                  <div class="flex justify-center"> 
                      <img src="/storage/{{ $post->image_path }}" id="postImage" style="max-height: 80vh"> 
                  </div>
              </div>
              <div class="col-span-2 bg-white flex flex-col">
                  <div class="flex flex-row p-3 border-b border-solid border-gray-300 items-center justify-between" id="sec1">       
                      <div class="flex flex-row items-center">
                          <img src="{{ $post->user->profile_photo_url }}"
                              alt="{{ $post->user->username }}" srcset=""
                              class="rounded-full h-10 w-10 me-3 ">
                          <a class="font-bold hover:underline"
                              href="/{{ $post->user->username }}">{{ $post->user->username }} </a> 
                      </div>

                      @can('update', $post)

                          <div class="text-gray-500">
                              <a href="/posts/{{ $post->id }}/edit"><i class="fas fa-edit"></i></a>
                              <span class="font-bold mx-2">|</span>  
                          <form class="inline-block" action="{{ route('posts.destroy',$post->id) }}" method="POST" >
                              @csrf
                              @method('DELETE')
                              <button  type="submit" onclick="return confirm('Are you sure you want to delete this Post? this will delete your post permanently.')">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </form>
                          </div>             
                      @endcan

                      @cannot('update', $post)
                      {{-- @livewire('follow-button',['profile_id' => $post->user->id ], key($post->user->id)) --}}
                      @endcannot
                  </div>
                  <div class="border-b border-solid border-gray-300 h-full">
                      <div class="grid grid-cols-5 overflow-y-auto" id="commentArea">
                          <div class="col-span-1 m-3">
                              <img src="{{ $post->user->profile_photo_url }}"
                                  alt="{{ $post->user->username }}" class="rounded-full h-10 w-10 ">
                          </div>
                          <div class="col-span-4 mt-5 me-7">
                              <a class="font-bold hover:underline"
                                  href="/{{ $post->user->username }}">{{ $post->user->username }} </a>
                              <span>{{ $post->post_caption }}</span>
                          </div>
                          {{-- @foreach ($post->comments as $comment)
                          <div class="col-span-1 m-3">
                              <img src="{{ $comment->user->profile_photo_url }}"
                                  alt="{{ $comment->user->username }}" srcset="" class="rounded-full h-10 w-10 ">
                          </div>
                          <div class="col-span-4 mt-5 me-7">
                              <a class="font-bold hover:underline"
                                  href="/{{ $comment->user->username }}">{{ $comment->user->username }} </a>
                              <span>{{ $comment->comment }}</span>
                              <div class="text-gray-500 text-xs">{{ $comment->created_at->format('M j o') }}  
                                  @can('delete', $comment)
                                  <form class="inline-block" action="{{ route('comments.destroy',$comment->id) }}" method="POST" >
                                      @csrf
                                      @method('DELETE')
                                      <button class="text-xs ms-2" type="submit" onclick="return confirm('Are you sure you want to delete this Comment? this will delete your comment permanently.')">
                                          <i class="fa fa-trash"></i>
                                      </button>
                                  </form>
                                  @endcan  
                                  @can('update', $comment)
                                  <a href="/comments/{{ $comment->id }}/edit" class="text-xs ms-2"><i class="fas fa-edit"></i></a>
                                  @endcan 
                              </div>
                          </div>
                          @endforeach --}}
                      </div>
                  </div>
                  <div class="flex flex-col" id="sec3">
                      {{-- @livewire('like-button', ['post_id' => $post->id], key($post->id))    --}}
                      <div class="border-b border-solid border-gray-300 ps-4 pb-1 text-xs">
                          {{ $post->created_at->format('M j o') }}
                      </div>                     
                  </div>
                  <div class="p-4" id="sec4">
                      {{-- @if(Auth::check()) --}}
                      <form action="/comments" method="post" autocomplete="off">
                          @csrf
                          <div class="flex flex-row items-center justify-between">
                              <input class="w-full outline-none border-none p-1" type="text" 
                              id="comment{{$post->id}}" placeholder="{{__('Add Comment')}}" name="comment"  autofocus />
                              <input type="hidden" name="post_id" value="{{$post->id}}">
                              <button class="text-blue-500 font-semibold hover:text-blue-700" type="submit">{{__('Post')}}</button>
                          </div>
                      </form>
                      {{-- @else
                      <a href="{{ route('login') }}" class="text-blue-500 text-sm">{{__('Log In')}}</a>
                      <span  class="text-sm">{{__(' to like or comment')}}</span>
                      @endif --}}
                  </div>
              </div>
          </div>
      </div>
  </div>
 
  
</x-app-layout>