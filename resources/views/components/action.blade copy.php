@props(['fieldId' => '', 'url' => '', 'isEdit' => false])

<x-dropdown icon="bars-3" class="w-fit">
  @if ($isEdit)
    <x-dropdown.item :href="url($url, ['edit', $fieldId])" {{ $attributes }} wire:navigate>
      <span class="text-cyan-500 font-bold">Edit</span>
    </x-dropdown.item>
  @endif
</x-dropdown>
