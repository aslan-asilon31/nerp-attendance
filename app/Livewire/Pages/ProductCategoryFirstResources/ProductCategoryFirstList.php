<?php

namespace App\Livewire\Pages\ProductCategoryFirstResources;

use Livewire\Component;

class ProductCategoryFirstList extends Component
{
  public $title= 'Product Category First';
  
  public function render()
  {
    
    return view('livewire.pages.product-category-first-resources.product-category-first-list')
    ->title($this->title);

  }
}
