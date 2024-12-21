@props(['url' => ''])

<div class="grid grid-cols-2 grid-rows-1 gap-0">
  <div>
    <x-button green label="Create" href="{{ $url }}/create" wire:navigate />
  </div>
  <div class="ml-auto my-auto">
    {{-- <x-button orange label="Export" /> --}}
  </div>
</div>
