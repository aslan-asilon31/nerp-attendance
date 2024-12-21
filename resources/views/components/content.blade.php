@props(['title' => 'No Title'])

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
  <x-notification />

  <div class="border-b border-stroke p-4 dark:border-strokedark">
    <h1 class="text-center font-medium text-black dark:text-white text-xl">
      {{ $title }}
    </h1>
  </div>
  <div class="p-4">
    {{ $slot }}
  </div>
</div>
