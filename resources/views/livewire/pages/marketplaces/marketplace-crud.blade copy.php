<x-content :title="$title">
  {{-- https://github.com/spatie/livewire-filepond --}}


  <form wire:submit="update">

    <div class="mb-3">
      <x-label for="marketplaceForm-name">
        Name
      </x-label>
      <x-input wire:model="marketplaceForm.name" id="marketplaceForm-name" name="marketplaceForm-name" placeholder="Name" />
    </div>

    <div class="mb-3">
      <x-label for="marketplaceForm-url">
        URL
      </x-label>
      <x-input wire:model="marketplaceForm.url" id="marketplaceForm-url" name="marketplaceForm-url" placeholder="URL" />
    </div>

    {{-- <div class="mb-3">
      <x-label for="marketplaceForm-image_url">
        Image
      </x-label>
      <x-filepond::upload wire:model="marketplaceForm.image_url" id="marketplaceForm-image_url"
        name="marketplaceForm-image_url" />
    </div> --}}
    <div class="mb-3">
      <x-label for="image">
        Image
      </x-label>
      <x-filepond::upload wire:model="image" id="image" name="image" />
    </div>

    <div class="mb-3">
      <x-label for="marketplaceForm-ordinal">
        Ordinal
      </x-label>
      <x-number wire:model="marketplaceForm.ordinal" id="marketplaceForm-ordinal" name="marketplaceForm-ordinal"
        placeholder="Ordinal" min="0" />
    </div>

    <div class="mb-3">
      <x-label for="marketplaceForm-is_activated">
        Activate
      </x-label>
      <x-native-select wire:model="marketplaceForm.is_activated" id="marketplaceForm-is_activated"
        name="marketplaceForm-is_activated" :options="[['label' => 'Yes', 'value' => true], ['label' => 'No', 'value' => false]]" option-label="label" option-value="value" />
    </div>

    <div class="mt-4">
      <x-button type="submit" label="Update" class="w-full" cyan />
    </div>


    @if ($errors->any())
    <x-alert title="Error, perhatikan data Anda!" negative padding="pl-14">
      <x-slot name="slot">
        <ul class="list-disc text-base">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </x-slot>
    </x-alert>
    @endif
  </form>


</x-content>