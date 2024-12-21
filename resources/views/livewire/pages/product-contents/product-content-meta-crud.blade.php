<x-content :title="$title">
  <x-form-menu :url="$url" :fieldId="$id" :isDeleteShowed="false" />

  <x-product-contents.product-content-tab activatedTab="product-content-metas" :fieldId="$id" />
  <div class="mb-4">
    <h1 class="font-bold text-center">{{ $productContent['product']['name'] }}</h1>
    <h2 class="font-bold text-center">{{ $productContent['title'] }}</h2>
  </div>

  <div class="mb-2">
    <x-button label="Create" wire:click.debounce.500ms="createProductContentMeta()" green />
  </div>

  <div class="overflow-x-scroll rounded-lg border min-h-80">
    <table class="min-w-full border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Action</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Ordinal</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Property Group</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Property</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap">Content</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($productContent['product_content_metas'] as $index => $item)
          <tr class="bg-white hover:bg-gray-50">
            <td class="px-2 py-2 border border-gray-300 text-center text-nowrap">
              <x-dropdown icon="bars-3" class="w-fit">
                <x-dropdown.item wire:click.debounce.500ms="editProductContentMeta('{{ $item['id'] }}')"
                  label="Edit" />
                <x-dropdown.item wire:click.debounce.500ms="deleteProductContentMeta('{{ $item['id'] }}')"
                  wire:confirm="Do you want to delete this data?" label="Delete" />
              </x-dropdown>
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-right">{{ $item['ordinal'] }}</td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">
              {{ $item['meta_property']['meta_property_group']['name'] }}
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['meta_property']['name'] }}</td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['content'] }}</td>
          </tr>
        @empty
          <tr>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-center" colspan="100%">Data not found</td>
          </tr>
        @endforelse

      </tbody>
    </table>
  </div>

  <x-modal-card title="Product Content Meta ({{ $productContentMetaId ? 'Edit' : 'Create' }})"
    name="productContentMetaCardModal" persistent z-index="z-[99991]">

    <form
      wire:submit="{{ $productContentMetaId ? "updateProductContentMeta('{$productContentMetaId}')" : 'storeProductContentMeta' }}"
      wire:confirm="{{ $productContentMetaId ? 'Do you want to update this data?' : 'Do you want to store this data?' }}">

      <div class="mb-3">
        <x-label for="masterForm.meta_property_id">Meta Property {{ $masterForm->meta_property_id }}</x-label>
        <x-select wire:model.live="masterForm.meta_property_id" placeholder="Meta Property" :async-data="[
            'api' => url('/api/v1/select/meta-properties'),
        ]"
          option-label="name" option-value="id" />
      </div>

      <div class="mb-3">
        <x-label for="masterForm.content">Content</x-label>
        <x-input wire:model="masterForm.content" placeholder="Content" />
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
        @if ($productContentMetaId)
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
    wire:target="createProductContentMeta, storeProductContentMeta, editProductContentMeta, updateProductContentMeta, deleteProductContentMeta"
    class="fixed left-0 top-0 w-full h-full bg-black opacity-25  z-[99999]">
    <div class="w-full h-full flex justify-center items-center">
      <x-form-loading />
    </div>
  </div>

  {{-- <pre>
  {{ print_r($productContent) }}
  </pre> --}}
</x-content>
