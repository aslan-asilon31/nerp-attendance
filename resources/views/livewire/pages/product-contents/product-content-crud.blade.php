<x-content :title="$title">


  <x-form-menu :url="$url" :fieldId="$id" />

  <x-tabs wire:model="selectedTab" class="">

    @if ($selectedTab === '/product-contents')
        <x-tab name="content-tab" label="Content" icon="o-sparkles" >
          <div>Content</div>
        </x-tab>
    @endif


    @if ($selectedTab === '/product-content-metas')
        <x-tab name="meta-tab" label="Meta" icon="o-sparkles" >
          <div>Meta</div>
        </x-tab>
    @endif


      {{-- <x-tab name="content-tab" label="Content" icon="o-sparkles" class="">
        @php
            $ProductCategoryFirst = App\Models\ProductCategoryFirst::take(5)->get();
        @endphp
        
        <x-select label="Master user" icon="o-user" :options="$ProductCategoryFirst" wire:model="selectedUser" />
        <div  class="mt-4">
          <x-input label="Title" placeholder="Title Name"  />
        </div>

        <div class="mt-4">
          <x-input label="Slug" placeholder="Slug Name" />
        </div>

        <div class="mt-4">
          <x-input label="URL" placeholder="URL Name" />
        </div>
        <div class="mt-4">
          <x-file wire:model="photo2" label="Image" accept="image/*" crop-after-change>
            <img
              src="{{ $user->avatar ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
              class="h-50 rounded-lg" />
          </x-file>
        </div>
        <div class="mt-4">
          <x-dropdown label="Yes" no-x-anchor top>
              <x-menu-item title="Yes" />
              <x-menu-item title="No" />
          </x-dropdown>
        </div>
      </x-tab> --}}





      <x-tab name="display-tab" label="Display" icon="o-sparkles">
          <div>display</div>
      </x-tab>

      <x-tab name="video-tab" label="Video" icon="o-sparkles">
          <div>video</div>
      </x-tab>

      <x-tab name="specification-tab" label="Specification" icon="o-sparkles">
          <div>specification</div>
      </x-tab>
      <x-tab name="feature-tab" label="Feature" >
          <div>feature</div>
      </x-tab>
      <x-tab name="review-tab" label="Review" >
          <div>review</div>
      </x-tab>
      <x-tab name="qna-tab" label="QnA" >
          <div>qna</div>
      </x-tab>
      <x-tab name="users-tab" label="Users" icon="o-users">
        <x-form :fieldId="$id">
          <div class="text-center border-t pt-4">
            <x-button label="Create" class="btn-success text-white" />
          </div>
        </x-form>
      </x-tab>
      
      <x-button class="btn-success">
          Update
      </x-button>

  </x-tabs>

  
</x-content>
