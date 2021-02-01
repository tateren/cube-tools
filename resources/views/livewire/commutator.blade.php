<div>
    <ul class="text-red-500">
        @error('setup') <li class="error">{{ $message }}</li> @enderror
        @error('a') <li class="error">{{ $message }}</li> @enderror
        @error('b') <li class="error">{{ $message }}</li> @enderror
    </ul>
    <div class="text-3xl">
    [<input type="text" name="setup" wire:model="setup" placeholder="SETUP" class="mt-0 px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">:
    [<input type="text" name="a" wire:model="a" placeholder="A" class="mt-0 px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">,
    <input type="text" name="b" wire:model="b" placeholder="B" class="mt-0 px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">]]
    </div>
    <button wire:click="invert" class="border rounded font-bold px-1 my-2 hover:bg-gray-200">Invert</button>
    <p class="{{isset($result) ? 'text-5xl': ''}}">{{$result ?? 'Please input algorithm.'}}</p>
</div>
