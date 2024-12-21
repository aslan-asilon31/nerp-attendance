<?php

namespace App\Livewire\Pages\ProductContentResources;

use App\Livewire\Pages\ProductContents\Forms\ProductContentForm;
use App\Models\ProductContent;
use Livewire\Component;

class ProductContentCrud extends Component
{

  public function render()
  {
    return view('livewire.pages.product-contents.product-content-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content';
  public string $selectedTab  = '/product-contents';
  public string $url = '/product-contents';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  private string $model = ProductContent::class;
  public ProductContentForm $masterForm;

  private string $uploadFolderName = 'files/images/product-contents';
  private string $baseImageName = 'product-content-image';

  public function create()
  {
    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->id),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $folderName = 'files/product-contents/' . e($this->id);
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl = null;
    $validatedForm['image_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $validatedForm['slug'] = str($validatedForm['title'])->slug();
    $record = $this->model::create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->url . "/edit/{$record?->id}", true);
  }

  public function edit()
  {
    $record = $this->model::findOrFail($this->id);
    // $this->masterForm->fill($record);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->id),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);

    $folderName = 'files/product-contents/' . e($this->id);
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
    $this->redirect($this->url . "/edit/{$record?->id}", true);
  }

  public function delete()
  {
    $record = $this->model::findOrFail($this->id);

    $this->deleteImage($record->image_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->url, true);
  }

  public function updatedMasterFormTitle()
  {
    $this->masterForm->slug = str($this->masterForm->title)->slug;
    $this->masterForm->url = '/p/' . str($this->masterForm->title)->slug;
  }
}
