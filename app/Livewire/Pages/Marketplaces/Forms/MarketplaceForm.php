<?php

namespace App\Livewire\Pages\Marketplaces\Forms;

use App\Models\Marketplace;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class MarketplaceForm extends Form
{
  public string|null $name = null;
  public string|null $url = null;
  public TemporaryUploadedFile|string|null $image_url = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(null|string $id = null)
  {
    return [
      'masterForm.name' => [
        'required',
        'string',
        function (string $attribute, mixed $value, \Closure $fail) use ($id) {
          $slugName = str($value)->slug('_');
          $recordCount = 0;
          if ($id) {
            $recordCount = Marketplace::query()
              ->where('id', '!=', $id)
              ->where('id', $slugName)
              ->count();
          } else {
            $recordCount = Marketplace::where('id', $slugName)->count();
          }

          if ($recordCount) {
            $fail("The Name has already been taken.");
          }
        },
      ],
      'masterForm.url' => 'required|string',
      'masterForm.image_url' => [
        'nullable',
        function (string $attribute, mixed $value, \Closure $fail) {
          if (!is_string($value) && !($value instanceof TemporaryUploadedFile)) {
            $fail("The Image URL must be string or image.");
          }
        },
      ],
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.url' => 'URL',
      'masterForm.image_url' => 'Image',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
