<?php

namespace App\Livewire\Pages\MetaPropertyGroups;

use Livewire\Component;

class MetaPropertyGroupIndex extends Component
{
  public function render()
  {
    return view('livewire.pages.meta-property-groups.meta-property-group-index')
      ->title($this->title);
  }

  public string $title = 'Meta Property Group';
  public string $url = '/meta-property-groups';
}
