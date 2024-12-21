<a {{ $attributes }}
  {{ $attributes->merge(['class' => 'text-blue-600 hover:text-blue-800 visited:text-purple-600']) }}>{{ $slot }}</a>
