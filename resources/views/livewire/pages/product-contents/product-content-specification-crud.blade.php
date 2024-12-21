<x-content :title="$title">
  <x-form-menu :url="$url" :fieldId="$id" :isDeleteShowed="false" />

  <x-product-contents.product-content-tab activatedTab="product-content-specifications" :fieldId="$id" />
  <div class="mb-4">
    <h1 class="font-bold text-center">{{ $productContent['product']['name'] }}</h1>
    <h2 class="font-bold text-center">{{ $productContent['title'] }}</h2>
  </div>

  <div class="mb-2">
    <x-button label="Create" wire:click.debounce.500ms="createProductContentSpecification()" green />
  </div>

  <div class="overflow-x-scroll rounded-lg border min-h-80">
    <table class="min-w-full border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Action</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Ordinal</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Name</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap">Description</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($productContent['product_content_specifications'] as $index => $item)
          <tr class="bg-white hover:bg-gray-50">
            <td class="px-2 py-2 border border-gray-300 text-center text-nowrap">
              <x-dropdown icon="bars-3" class="w-fit">
                <x-dropdown.item wire:click.debounce.500ms="editProductContentSpecification('{{ $item['id'] }}')"
                  label="Edit" />
                <x-dropdown.item wire:click.debounce.500ms="deleteProductContentSpecification('{{ $item['id'] }}')"
                  wire:confirm="Do you want to delete this data?" label="Delete" />
              </x-dropdown>
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-right">{{ $item['ordinal'] }}</td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['name'] }}</td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['description'] }}</td>
          </tr>
        @empty
          <tr>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-center" colspan="100%">Data not found</td>
          </tr>
        @endforelse

      </tbody>
    </table>
  </div>

  <x-modal-card title="Product Content Specification ({{ $productContentSpecificationId ? 'Edit' : 'Create' }})"
    name="productContentSpecificationCardModal" persistent z-index="z-[99991]">

    <form
      wire:submit="{{ $productContentSpecificationId ? "updateProductContentSpecification('{$productContentSpecificationId}')" : 'storeProductContentSpecification' }}"
      wire:confirm="{{ $productContentSpecificationId ? 'Do you want to update this data?' : 'Do you want to store this data?' }}">

      <div class="mb-3">
        <x-label for="masterForm.name">Name</x-label>
        <x-input wire:model="masterForm.name" placeholder="Name" />
      </div>

      <div class="mb-3">
        <x-label for="masterForm.description">Description</x-label>
        <x-input wire:model="masterForm.description" placeholder="Description" />
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

      <div class="mt-4 text-center">
        @if ($productContentSpecificationId)
          <x-button type="submit" label="Update" cyan />
        @else
          <x-button type="submit" label="Store" green />
        @endif
        <x-button label="Cancel" x-on:click="close" secondary />
      </div>



      <x-errors class="mt-4" />
    </form>



  </x-modal-card>

  <div wire:loading
    wire:target="createProductContentSpecification, storeProductContentSpecification, editProductContentSpecification, updateProductContentSpecification, deleteProductContentSpecification"
    class="fixed left-0 top-0 w-full h-full bg-black opacity-25  z-[99999]">
    <div class="w-full h-full flex justify-center items-center">
      <x-form-loading />
    </div>
  </div>

  {{-- <pre>
  {{ print_r($productContent) }}
  </pre> --}}
</x-content>
