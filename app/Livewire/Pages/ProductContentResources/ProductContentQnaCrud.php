<?php

namespace App\Livewire\Pages\ProductContentResources;

use App\Livewire\Pages\ProductContents\Forms\ProductContentQnaForm;
use Livewire\Component;

class ProductContentQnaCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-qna-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Qna';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-qnas';

  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \WireUi\Traits\WireUiActions;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentQnaId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentQnaForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-qnas';
  private string $baseImageName = 'product_content_qna_image';


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentQnas' => function ($q) {
        $q->orderBy('product_content_qnas.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentQna()
  {
    $this->productContentQnaId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentQnas()
      ?->max('ordinal') + 1;

    $this->modal()->open('productContentQnaCardModal');
  }

  public function storeProductContentQna()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentQnaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);
    $record->productContentQnas()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentQna($productContentQnaId)
  {
    $this->productContentQnaId = $productContentQnaId;
    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentQnaCardModal');
  }

  public function updateProductContentQna($productContentQnaId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentQnaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId)
      ->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentQna($productContentQnaId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
