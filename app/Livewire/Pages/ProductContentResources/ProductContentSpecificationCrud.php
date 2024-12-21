<?php

namespace App\Livewire\Pages\ProductContents;

use App\Livewire\Pages\ProductContents\Forms\ProductContentSpecificationForm;
use Livewire\Component;

class ProductContentSpecificationCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-specification-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Specification';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-specifications';

  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \WireUi\Traits\WireUiActions;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentSpecificationId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentSpecificationForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-specifications';
  private string $baseImageName = 'product_content_specification_image';


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentSpecifications' => function ($q) {
        $q->orderBy('product_content_specifications.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentSpecification()
  {
    $this->productContentSpecificationId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentSpecifications()
      ?->max('ordinal') + 1;

    $this->modal()->open('productContentSpecificationCardModal');
  }

  public function storeProductContentSpecification()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentSpecificationId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);
    $record->productContentSpecifications()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentSpecification($productContentSpecificationId)
  {
    $this->productContentSpecificationId = $productContentSpecificationId;
    $record = $this->model::findOrFail($this->id)
      ->productContentSpecifications()
      ->findOrFail($productContentSpecificationId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentSpecificationCardModal');
  }

  public function updateProductContentSpecification($productContentSpecificationId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentSpecificationId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentSpecifications()
      ->findOrFail($productContentSpecificationId)
      ->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentSpecification($productContentSpecificationId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentSpecifications()
      ->findOrFail($productContentSpecificationId);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
