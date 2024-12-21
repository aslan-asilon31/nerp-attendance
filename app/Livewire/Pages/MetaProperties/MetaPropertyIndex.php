<?php

namespace App\Livewire\Pages\MetaProperties;

use Livewire\Component;

class MetaPropertyIndex extends Component
{
  public function render()
  {
    return view('livewire.pages.meta-properties.meta-property-index')
      ->title($this->title);
  }

  public string $title = 'Meta Property';
  public string $url = '/meta-properties';
}
