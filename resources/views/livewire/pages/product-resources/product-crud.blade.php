<x-content :title="$title">
  <x-form-menu :url="$url" :fieldId="$id" />

  <x-form :fieldId="$id">

    <div class="mb-3">
      <x-label for="masterForm.product_category_first_id">Product Category 1</x-label>
      <x-select wire:model="masterForm.product_category_first_id" placeholder="Product Category 1" :async-data="[
          'api' => url('/api/v1/select/product-category-firsts'),
      ]"
        option-label="name" option-value="id" />
    </div>

    <div class="mb-3">
      <x-label for="masterForm.name">Name</x-label>
      <x-input wire:model="masterForm.name" placeholder="Name" />
    </div>
    <div class="mb-3">
      <x-label for="masterForm.selling_price">Selling Price</x-label>
      <x-currency wire:model="masterForm.selling_price" placeholder="Selling Price" placeholder="0" precision="4" />
    </div>
    <div class="mb-3">
      <x-label for="masterForm.availability">Availability</x-label>
      <x-select wire:model="masterForm.availability" :options="[
          ['label' => 'In Stock', 'value' => 'in-stock'],
          ['label' => 'Out Of Stock', 'value' => 'out-of-stock'],
      ]" option-label="label" option-value="value"
        :clearable="false" />
    </div>
    <div class="mb-3">
      <x-label for="masterForm.image_url">Image</x-label>
      <x-image-upload wire:model="masterForm.image_url" placeholder="Image Url" />
      <x-image-preview :imageUrl="$masterForm?->image_url" />
    </div>
    <div class="mb-3">
      <x-label for="masterForm.is_activated">Activate</x-label>
      <x-select wire:model="masterForm.is_activated" :options="[['label' => 'Yes', 'value' => 1], ['label' => 'No', 'value' => 0]]" option-label="label" option-value="value"
        :clearable="false" />
    </div>
  </x-form>

</x-content>
