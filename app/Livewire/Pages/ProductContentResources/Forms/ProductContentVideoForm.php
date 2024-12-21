<?php

namespace App\Livewire\Pages\ProductContents\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductContentVideoForm extends Form
{
  public string|null $name = null;
  public TemporaryUploadedFile|string|null $thumbnail_url = null;
  public $video_url = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.thumbnail_url' => [
        'nullable',
        new \App\Rules\StringOrImageRule,
      ],
      'masterForm.video_url' => [
        'nullable',
        new \App\Rules\StringOrVideoRule,
      ],
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.thumbnail_url' => 'Thumbnail',
      'masterForm.video_url' => 'Video',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
