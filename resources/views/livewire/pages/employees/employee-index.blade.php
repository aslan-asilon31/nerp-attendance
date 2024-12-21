<x-content :title="$title">
  {{-- <select
    class="appearance-none !bg-none focus:ring-primary-600 focus-within:focus:ring-primary-600 focus-within:ring-primary-600 dark:focus-within:ring-primary-600 flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-pg-primary-600 dark:text-pg-primary-300 text-gray-600 ring-gray-300 dark:bg-pg-primary-800 bg-white dark:placeholder-pg-primary-400 rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-none sm:text-sm sm:leading-6 w-full  power_grid"
    style="" id="selectField">
    <option value="">Semua</option>
    <option value="admin">
      Admin
    </option>
    <option value="developer">
      Developer
    </option>
  </select> --}}

  <livewire:pages.employees.components.employee-table />
</x-content>
