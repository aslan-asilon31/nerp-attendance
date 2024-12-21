<?php

namespace App\Livewire\Pages\ProductContentResources;

use App\Livewire\Pages\ProductContents\Forms\ProductContentDisplayForm;
use Livewire\Component;

class ProductContentDisplayCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-display-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Display';
  public string $url = '/product-contents';
  public string $selectedTab  = '/product-content-displays';
  public string $redirectUrl = '/product-content-displays';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentDisplayId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentDisplayForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-displays';
  private string $baseImageName = 'product-content-display-image';


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentDisplays' => function ($q) {
        $q->orderBy('product_content_displays.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentDisplay()
  {
    $this->productContentDisplayId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentDisplays()
      ?->max('ordinal') + 1;

    $this->masterForm->name = $this->productContent['product']['name'] . ' Display Image ' . sprintf('%02d', $this->masterForm->ordinal);

    $this->modal()->open('productContentDisplayCardModal');
  }

  public function storeProductContentDisplay()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentDisplayId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-displays';
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl = null;
    $validatedForm['image_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $record = $this->model::findOrFail($this->id);
    $record->productContentDisplays()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentDisplay($productContentDisplayId)
  {
    $this->productContentDisplayId = $productContentDisplayId;
    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentDisplayCardModal');
  }

  public function updateProductContentDisplay($productContentDisplayId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentDisplayId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId);

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-displays';
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl = $record->image_url;
    $validatedForm['image_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $record->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentDisplay($productContentDisplayId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId);

    $this->deleteImage($record->image_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
