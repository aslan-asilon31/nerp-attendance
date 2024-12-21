<?php

namespace App\Livewire\Pages\ProductContentResources;

use App\Livewire\Pages\ProductContents\Forms\ProductContentFeatureForm;
use Livewire\Component;

class ProductContentFeatureCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-feature-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Feature';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-features';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \WireUi\Traits\WireUiActions;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentFeatureId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentFeatureForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-features';
  private string $baseImageName = 'product-content-feature-image';

  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentFeatures' => function ($q) {
        $q->orderBy('product_content_features.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentFeature()
  {
    $this->productContentFeatureId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentFeatures()
      ?->max('ordinal') + 1;

    $this->masterForm->name = $this->productContent['product']['name'] . ' Feature Image ' . sprintf('%02d', $this->masterForm->ordinal);

    $this->modal()->open('productContentFeatureCardModal');
  }

  public function storeProductContentFeature()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentFeatureId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-features';
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
    $record->productContentFeatures()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentFeature($productContentFeatureId)
  {
    $this->productContentFeatureId = $productContentFeatureId;
    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentFeatureCardModal');
  }

  public function updateProductContentFeature($productContentFeatureId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentFeatureId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId);

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-features';
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl =  $record->image_url;
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

  public function deleteProductContentFeature($productContentFeatureId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId);

    $this->deleteImage($record->image_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
