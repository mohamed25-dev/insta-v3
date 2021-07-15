<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-center">
      <h1 class="text-2xl md:text-5xl mt-7">
        {{ __('Apply Filters')}}
      </h1>
    </div>
  </x-slot>

  @livewire('filters', ['postCaption' => $postCaption, 'imagePath' => $imagePath])

</x-app-layout>