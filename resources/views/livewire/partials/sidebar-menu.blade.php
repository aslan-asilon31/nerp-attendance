<x-menu activate-by-route>

  {{-- User --}}
  @if ($user = auth()->user() && auth()->user()->employee)
    <x-menu-separator />

    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
      <x-slot:actions>
        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="Logout" no-wire-navigate
          wire:click="logout" />
      </x-slot:actions>
    </x-list-item>
    <x-menu-separator />
    @else
    <!-- Handle case when employee is not available -->
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

  <x-menu-sub title="{{ auth()->user()->employee?->name ?? 'Unknow' }}" icon="o-cog-6-tooth">
    <x-menu-item title="Profile" icon="o-user-circle" link="####" />
    <x-menu-item wire:click="logout" title="Logout" icon="o-x-circle" />
    {{-- <x-menu-item title="sample" icon="o-arrow-right-circle" link="####" /> --}}
  </x-menu-sub>

</x-menu>
