<?php

namespace App\Livewire\Pages\ProductCategorySecondResources;

use App\Livewire\Pages\ProductCategorySecondResources\Forms\ProductCategorySecondForm;
use Livewire\Component;

class ProductCategorySecondList extends Component
{
  public $title = 'Product Category Second';
  
  public function render()
  {
    
    return view('livewire.pages.product-category-second-resources.product-category-second-list')
    ->title($this->title);

  }
}
