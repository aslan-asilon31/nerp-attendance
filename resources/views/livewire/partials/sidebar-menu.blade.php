<x-menu activate-by-route>

  {{-- User --}}
  @if ($user = auth()->user()->employee)
    <x-menu-separator />

    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
      <x-slot:actions>
        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="Logout" no-wire-navigate
          wire:click="logout" />
      </x-slot:actions>
    </x-list-item>
    <x-menu-separator />
  @endif
  <x-menu-item title="Dashboard" icon="o-home" link="/" />
  <x-menu-separator title="Management" icon="o-sparkles" />
  <x-menu-item 
    title="Employees" 
    icon="o-squares-2x2" 
    link="/employees" 
    :class="request()->is('employees') ? 'active' : ''" 
  />

  <x-menu-item title="Permission" icon="o-squares-2x2" link="####" />


  <x-menu-separator title="Content" icon="o-sparkles" />
  
  <x-menu-item 
      title="Marketplace" 
      icon="o-squares-2x2" 
      link="/marketplaces" 
      :class="request()->is('marketplaces') ? 'active' : ''" 
  />
  
  <x-menu-item 
      title="Meta Property Group" 
      icon="o-squares-2x2" 
      link="/meta-property-groups" 
      :class="request()->is('meta-property-groups') ? 'active' : ''" 
  />

  <x-menu-item 
      title="Meta Property " 
      icon="o-squares-2x2" 
      link="/meta-properties" 
      :class="request()->is('meta-properties') ? 'active' : ''" 
  />

  <x-menu-item 
      title="Product Category 1" 
      icon="o-squares-2x2" 
      link="/product-category-firsts" 
      :class="request()->is('product-category-firsts') ? 'active' : ''" 
  />
  <x-menu-item 
      title="Product Category 2" 
      icon="o-squares-2x2" 
      link="/product-category-seconds" 
      :class="request()->is('product-category-seconds') ? 'active' : ''" 
  />
  <x-menu-item 
      title="Product " 
      icon="o-squares-2x2" 
      link="/products" 
      :class="request()->is('products') ? 'active' : ''" 
  />
  
  <x-menu-item 
      title="Product Content" 
      icon="o-squares-2x2" 
      link="/product-contents" 
      :class="request()->is('product-contents') ? 'active' : ''" 
  />
  <x-menu-item 
    title="Product Content Meta" 
    icon="o-squares-2x2" 
    link="/product-content-metas" 
    :class="request()->is('product-content-metas') ? 'active' : ''" 
  />

  <x-menu-separator title="Sales" icon="o-sparkles" />
  <x-menu-item title="Customer" icon="o-squares-2x2" link="####" />
  <x-menu-item title="Sales Cart" icon="o-squares-2x2" link="####" />
  <x-menu-item title="Sales Order" icon="o-squares-2x2" link="####" />
  <x-menu-item title="Sales Invoice" icon="o-squares-2x2" link="####" />
  <x-menu-item title="Sales Payment" icon="o-squares-2x2" link="####" />
  <x-menu-sub title="{{ auth()->user()->employee?->name ?? 'Unknow' }}" icon="o-cog-6-tooth">
    <x-menu-item title="Profile" icon="o-user-circle" link="####" />
    <x-menu-item wire:click="logout" title="Logout" icon="o-x-circle" />
    {{-- <x-menu-item title="sample" icon="o-arrow-right-circle" link="####" /> --}}
  </x-menu-sub>

</x-menu>
