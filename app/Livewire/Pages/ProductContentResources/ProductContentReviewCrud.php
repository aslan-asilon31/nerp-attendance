<?php

namespace App\Livewire\Pages\ProductContents;

use App\Livewire\Pages\ProductContents\Forms\ProductContentReviewForm;
use Livewire\Component;

class ProductContentReviewCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-contents.product-content-review-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Review';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-reviews';

  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \WireUi\Traits\WireUiActions;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentReviewId = null;
  private string $model = \App\Models\ProductContent::class;
  public ProductContentReviewForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-reviews';
  private string $baseImageName = 'product_content_review_image';


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentReviews' => function ($q) {
        $q->orderBy('product_content_reviews.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentReview()
  {
    $this->productContentReviewId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentReviews()
      ?->max('ordinal') + 1;

    $this->modal()->open('productContentReviewCardModal');
  }

  public function storeProductContentReview()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentReviewId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id);
    $record->productContentReviews()
      ->create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function editProductContentReview($productContentReviewId)
  {
    $this->productContentReviewId = $productContentReviewId;
    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->modal()->open('productContentReviewCardModal');
  }

  public function updateProductContentReview($productContentReviewId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentReviewId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId)
      ->update($validatedForm);

    session()->flash('success_notification', __('messages.updated_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function deleteProductContentReview($productContentReviewId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
