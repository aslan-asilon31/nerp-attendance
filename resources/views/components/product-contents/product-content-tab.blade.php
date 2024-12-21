@props(['fieldId' => null, 'activatedTab' => ''])

<x-tab-link>
  @if ($fieldId)
    <x-tab-link-li href="/product-contents/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-contents'">
      Content
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-metas/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-metas'">
      Meta
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-displays/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-displays'">
      Display
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-videos/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-videos'">
      Video
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-specifications/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-specifications'">
      Specification
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-features/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-features'">
      Feature
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-reviews/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-reviews'">
      Review
    </x-tab-link-li>
    <x-tab-link-li href="/product-content-qnas/edit/{{ $fieldId }}" :isActivated="$activatedTab == 'product-content-qnas'">
      QnA
    </x-tab-link-li>
  @endif

</x-tab-link>
