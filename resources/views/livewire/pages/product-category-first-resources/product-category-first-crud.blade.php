<x-card :title="$title" shadow separator class="border shadow">

    <div class="grid grid-cols-2 mb-4">
      <div>
        <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />



        @if ($id && $readonly)
          <x-button label="Edit" link="{{ $url . '/edit/' . $id }}" class="btn-ghost btn-outline" />
        @endif
  
      </div>
      <div class="text-right">
            @if ($id && !$readonly)
            <x-button label="Delete" wire:click="delete" wire:confirm="Do you want to delete this data?"
                class="btn-ghost btn-outline text-red-500" />
            @endif
      </div>
    </div>
  
    <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">
  
      <x-choices-offline wire:model="masterForm.product_category_second_id" label="Product Category Second"
        :options="$options['product_category_seconds']" placeholder="Search ..." single searchable :readonly="$readonly" />
  
      <x-input wire:model="masterForm.name" label="Name" placeholder="Name" :readonly="$readonly" />
      <x-textarea wire:model="masterForm.description" label="Description" placeholder="Description" :readonly="$readonly" />
  
      <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$disabled">
        <img
          src="{{ $user->avatar ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
          class="h-48 rounded-lg" />
      </x-file>
  
      <x-file wire:model="masterForm.header_image_url" label="Header Image" accept="image/*" crop-after-change
        :disabled="$disabled">
        <img
          src="{{ $user->avatar ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
          class="h-48 rounded-lg" />
      </x-file>
  
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
        :readonly="$readonly" />
  
      @if ($id && !$readonly)
        <div class="text-center mt-3">
          <x-errors class="text-white mb-3" />
          <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
        </div>
      @endif

			@if(!$id)
			<x-button label="Create" link="{{ $url.'/create' }}" class="btn-ghost btn-outline" />
			@endif
			
    </x-form>
  
  
  </x-card>
  