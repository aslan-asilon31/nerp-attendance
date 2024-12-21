@props(['fieldId' => null, 'url' => '', 'isDeleteShowed' => true])

<div class="grid grid-cols-2 grid-rows-1 gap-0 mb-2">
  <div>
    <x-button label="List" href="{{ $url }}" wire:navigate />
    @if ($fieldId)
      <x-button green label="Create" href="{{ "$url/create" }}" wire:navigate />
    @endif
  </div>
  <div class="ml-auto">
    @if ($fieldId && $isDeleteShowed)
      <x-button red label="Delete" wire:click.debounce.500ms="delete" wire:confirm="Do you want to delete this data?" />
    @endif
  </div>
</div>
