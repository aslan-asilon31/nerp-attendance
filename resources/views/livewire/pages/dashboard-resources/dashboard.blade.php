<x-card :title="$title" shadow separator class="border shadow">

  <div class="grid grid-cols-2 mb-4">
    <div>
      <x-button label="List" link="/" class="btn-ghost btn-outline" />
    </div>
    <div class="text-right">
      <x-button label="Delete" wire:click="delete" class="btn-ghost btn-outline text-red-500" />
    </div>
  </div>

  <x-form>

    <x-input label="Name" placeholder="Your name" />
    <x-input label="Name" placeholder="Your name" />

    <x-file wire:model="photo2" label="Image" accept="image/*" crop-after-change>
      <img
        src="{{ $user->avatar ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
        class="h-50 rounded-lg" />
    </x-file>

    <div class="text-center border-t pt-4">
      <x-button label="Create" class="btn-success text-white" />
    </div>
  </x-form>


</x-card>
