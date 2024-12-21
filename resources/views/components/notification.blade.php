 @if (session('success_notification'))
   <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
     class="fixed top-0 right-0 flex justify-center lg:justify-end py-3 px-4 z-[9999]">
     <template x-if="show">
       <x-alert title="{{ session('success_notification') }}" positive />
     </template>
   </div>
 @endif
 {{-- <div class="fixed top-0 left-0 w-full flex justify-center lg:justify-end z-[9999] py-3">
  <x-alert title="Data successfully Deleted" positive class="w-fit" />
</div> --}}
