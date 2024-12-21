<?php

namespace App\Livewire\Pages\ProductResources;

use Livewire\Component;

class ProductList extends Component
{
  public function render()
  {
    return view('livewire.pages.product-resources.product-list')
      ->title($this->title);
  }
  public string $title = 'Product';
  public string $url = '/products';
}
