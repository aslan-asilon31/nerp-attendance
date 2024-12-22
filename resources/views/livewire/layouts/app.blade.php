<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


  <style>
    .swiper-slide img {
      width: 100%; /* Make the images fill the container */
      height: auto; /* Maintain aspect ratio */
    }
  </style>
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

  {{-- NAVBAR mobile only --}}
  <x-nav sticky class="lg:hidden">
    <x-slot:brand>
      <x-app-brand />
    </x-slot:brand>
    <x-slot:actions>
      <label for="main-drawer" class="lg:hidden me-3">
        <x-icon name="o-bars-3" class="cursor-pointer" />
      </label>
    </x-slot:actions>
  </x-nav>

  {{-- MAIN --}}
  <x-main full-width>
    {{-- SIDEBAR --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="!bg-purple-900 lg:bg-inherit">

      {{-- BRAND --}}
      <x-app-brand class="p-5 pb-0" />

      @livewire('partials.sidebar-menu')
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="bg-white">
      {{ $slot }}
    </x-slot:content>
  </x-main>

  {{--  TOAST area --}}
  <x-toast />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
</body>

</html>
