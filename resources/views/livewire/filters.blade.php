<div class="max-w-4xl my-0 mx-auto">
    <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-10">
        <div>
            <p class="text-center">{{__('original')}}</p>
            <img src="/storage/{{ $imagePath }}" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(0)">
        </div>
        <div>
            <p class="text-center">{{__('filter1')}}</p>
            <img src="/storage/uploads/1.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(1)">
        </div>
        <div>
            <p class="text-center">{{__('filter2')}}</p>
            <img src="/storage/uploads/2.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(2)">
        </div>
        <div>
            <p class="text-center">{{__('filter3')}}</p>
            <img src="/storage/uploads/3.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(3)">
        </div>
        <div>
            <p class="text-center">{{__('filter4')}}</p>
            <img src="/storage/uploads/4.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(4)">
        </div>
        <div>
            <p class="text-center">{{__('filter5')}}</p>
            <img src="/storage/uploads/5.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(5)">
        </div>
        <div>
            <p class="text-center">{{__('filter6')}}</p>
            <img src="/storage/uploads/6.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(6)">
        </div>
        <div>
            <p class="text-center">{{__('filter7')}}</p>
            <img src="/storage/uploads/7.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(7)">
        </div>
        <div>
            <p class="text-center">{{__('filter8')}}</p>
            <img src="/storage/uploads/8.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(8)">
        </div>
        <div>
            <p class="text-center">{{__('filter9')}}</p>
            <img src="/storage/uploads/9.jpeg" class="w-64 h-64 cursor-pointer" wire:model="filters" wire:click="applyFilter(9)">
        </div>
    </div>
</div>