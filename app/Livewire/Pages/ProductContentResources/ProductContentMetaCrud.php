<?php

namespace App\Livewire\Pages\ProductContentResources;

use App\Livewire\Pages\ProductContents\Forms\ProductContentMetaForm;
use App\Models\MetaProperty;
use Livewire\Component;

class ProductContentMetaCrud extends Component
{

  public function render()
  {
    return view('livewire.pages.product-contents.product-content-meta-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Meta';
  public string $url = '/product-contents';
  public string $selectedTab  = '/product-content-metas';
  public string $redirectUrl = '/product-content-metas';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentMetaId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentMetaForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-metas';
  private string $baseImageName = 'product_content_meta_image';


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentMetas' => function ($q) {
        $q->orderBy('product_content_metas.ordinal', 'asc');
        $q->with('metaProperty.metaPropertyGroup');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentMeta()
  {
    $this->productContentMetaId = null;
    $this->masterForm->reset();
    $this->modal()->open('productContentMetaCardModal');
  }

  public function storeProductContentMeta()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentMetaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);
    $record->productContentMetas()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentMeta($productContentMetaId)
  {
    $this->productContentMetaId = $productContentMetaId;
    $record = $this->model::findOrFail($this->id)
      ->productContentMetas()
      ->findOrFail($productContentMetaId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentMetaCardModal');
  }

  public function updateProductContentMeta($productContentMetaId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentMetaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentMetas()
      ->findOrFail($productContentMetaId)
      ->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentMeta($productContentMetaId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentMetas()
      ->findOrFail($productContentMetaId);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }


  public function updatedMasterFormMetaPropertyId($metaPropertyId)
  {
    $metaProperty = MetaProperty::find($metaPropertyId);
    $this->masterForm->ordinal = $metaProperty?->ordinal ? $metaProperty?->ordinal : 0;
  }
}
