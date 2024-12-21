@props(['fnRemoveVideoUrl' => 'removeVideoUrl'])

@if ($videoUrl)
  <div class="my-2 flex justify-center border py-4">
    <div class="border">
      <x-button wire:click.debounce.500ms="{{ $fnRemoveVideoUrl }}" wire:confirm="Do you want to remove this video?"
        negative label="Remove Video" rounded="false" class="w-full" />

      <div class="w-full aspect-video">
        <video controls>
          <source src="{{ $isTemporaryUrl ? $videoUrl->temporaryUrl() : $videoUrl }}" type="video/mp4">
          <source src="{{ $isTemporaryUrl ? $videoUrl->temporaryUrl() : $videoUrl }}" type="video/webm">
          Your browser does not support the video tag.
        </video>
      </div>

      {{-- <img src="{{ $isTemporaryUrl ? $videoUrl->temporaryUrl() : $videoUrl }}" alt="Temporary video" /> --}}
    </div>
  </div>
@endif
