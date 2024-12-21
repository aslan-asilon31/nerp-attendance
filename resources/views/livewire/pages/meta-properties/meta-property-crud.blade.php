<x-content :title="$title">
  <x-form-menu :url="$url" :fieldId="$id" />

  <x-form :fieldId="$id">

    <div class="mb-3">
      <x-label for="masterForm.meta_property_group_id">Meta Property Group</x-label>
      <x-select wire:model="masterForm.meta_property_group_id" placeholder="Meta Property" :async-data="[
          'api' => 'https://umedalife-private.test/api/v1/select/meta-property-groups',
      ]"
        option-label="name" option-value="id" />
    </div>

    <div class="mb-3">
      <x-label for="masterForm.name">Name</x-label>
      <x-input wire:model="masterForm.name" placeholder="Name" />
    </div>

    <div class="mb-3">
      <x-label for="masterForm.ordinal">Ordinal</x-label>
      <x-number wire:model="masterForm.ordinal" placeholder="Ordinal" min="0" />
    </div>

    <div class="mb-3">
      <x-label for="masterForm.is_activated">Activate</x-label>
      <x-select wire:model="masterForm.is_activated" :options="[['label' => 'Yes', 'value' => 1], ['label' => 'No', 'value' => 0]]" option-label="label" option-value="value"
        :clearable="false" />
    </div>
  </x-form>
</x-content>
