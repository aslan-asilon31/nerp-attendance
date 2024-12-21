<?php

namespace App\Livewire\Pages\ProductContents;

use App\Livewire\Pages\ProductContents\Forms\ProductContentVideoForm;
use Livewire\Component;

class ProductContentVideoCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-video-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Display';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-videos';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\VideoUpload\Traits\WithVideoUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \WireUi\Traits\WireUiActions;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentVideoId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentVideoForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-videos';
  private string $baseImageName = 'product-content-video-image';
  private string $baseVideoName = 'product-content-video';

  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentVideos' => function ($q) {
        $q->orderBy('product_content_videos.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentVideo()
  {
    $this->productContentVideoId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentVideos()
      ?->max('ordinal') + 1;

    $this->masterForm->name = $this->productContent['product']['name'] . ' Video ' . sprintf('%02d', $this->masterForm->ordinal);

    $this->modal()->open('productContentVideoCardModal');
  }

  public function storeProductContentVideo()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentVideoId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-videos';
    $newImageUrl = $validatedForm['thumbnail_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl = null;
    $validatedForm['thumbnail_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $newVideoUrl = $validatedForm['video_url'];
    $newVideoName = $this->id . '_' . $this->baseVideoName;
    $oldVideoUrl = null;
    $validatedForm['video_url'] = $this->saveVideo(
      $folderName,
      $newVideoUrl,
      $newVideoName,
      $oldVideoUrl
    );

    $record = $this->model::findOrFail($this->id);
    $record->productContentVideos()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentVideo($productContentVideoId)
  {
    $this->productContentVideoId = $productContentVideoId;
    $record = $this->model::findOrFail($this->id)
      ->productContentVideos()
      ->findOrFail($productContentVideoId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentVideoCardModal');
  }

  public function updateProductContentVideo($productContentVideoId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentVideoId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentVideos()
      ->findOrFail($productContentVideoId);

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-videos';
    $newImageUrl = $validatedForm['thumbnail_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl = $record->thumbnail_url;
    $validatedForm['thumbnail_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $newVideoUrl = $validatedForm['video_url'];
    $newVideoName = $this->id . '_' . $this->baseVideoName;
    $oldVideoUrl = $record->video_url;
    $validatedForm['video_url'] = $this->saveVideo(
      $folderName,
      $newVideoUrl,
      $newVideoName,
      $oldVideoUrl
    );


    $record->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentVideo($productContentVideoId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentVideos()
      ->findOrFail($productContentVideoId);

    $this->deleteImage($record->thumbnail_url);
    $this->deleteVideo($record->video_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
