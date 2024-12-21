<?php

namespace App\Livewire\Pages\Marketplaces;

use Livewire\Component;

class MarketplaceIndex extends Component
{
  public function render()
  {
    return view('livewire.pages.marketplaces.marketplace-index')
      ->title($this->title);
  }

  public string $title = 'Market Place';
  public string $url = '/marketplaces';
}
