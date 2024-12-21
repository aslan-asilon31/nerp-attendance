<x-content :title="$title">
  <form wire:submit="store">

    <div class="mb-3">
      <x-label for="employeeForm-position_id">
        Position
      </x-label>
      <x-select wire:model.live="employeeForm.position_id" id="employeeForm-position_id" name="employeeForm-position_id"
        placeholder="- Position -" :options="$options['positions']" option-label="name" option-value="id" />
    </div>

    <div class="mb-3">
      <x-label for="employeeForm-name">
        Name
      </x-label>
      <x-input wire:model.live="employeeForm.name" id="employeeForm-name" name="employeeForm-name" placeholder="Name" />
    </div>

    <div class="mb-3">
      <x-label for="employeeForm-phone">
        Phone
      </x-label>
      <x-input wire:model.live="employeeForm.phone" id="employeeForm-phone" name="employeeForm-phone"
        placeholder="Phone" />
    </div>

    <div class="mb-3">
      <x-label for="employeeForm-email">
        Email
      </x-label>
      <x-input wire:model.live="employeeForm.email" id="employeeForm-email" name="employeeForm-phone"
        placeholder="Email" />
    </div>

    <div class="mb-3">
      <x-label for="employeeForm-is_activated">
        Activate
      </x-label>
      <x-native-select wire:model.live="employeeForm.is_activated" id="employeeForm-is_activated"
        name="employeeForm-is_activated" placeholder="- Activate -" :options="[['name' => 'Yes', 'id' => 1], ['name' => 'No', 'id' => 0]]" option-label="name"
        option-value="id" />
    </div>

    <div class="mt-4">
      <x-button type="submit" positive label="Create" class="w-full" />
    </div>


  </form>
</x-content>
