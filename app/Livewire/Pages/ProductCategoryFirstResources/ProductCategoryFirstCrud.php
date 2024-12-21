<?php

namespace App\Livewire\Pages\ProductCategoryFirstResources;

use App\Livewire\Pages\ProductCategoryFirstResources\Forms\ProductCategoryFirstForm;
use Livewire\Component;

class ProductCategoryFirstCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.product-category-first-resources.product-category-first-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Product Category First';

  #[\Livewire\Attributes\Locked]
  public string $url = '/product-category-firsts';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public string $disabled = '';

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductCategoryFirst::class;

  public ProductCategoryFirstForm $masterForm;

  public function mount()
  {
    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }

    $this->initialize();
  }

  public function initialize()
  {
    $this->options['product_category_seconds'] = \App\Models\ProductCategorySecond::get()->all();
  }

  public function create()
  {
    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['slug'] = str($validatedForm['name'])->slug();
    $validatedForm['created_by'] = auth()->user()->username;
    $validatedForm['updated_by'] = auth()->user()->username;

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->readonly = 'readonly';
    $this->disabled = 'disabled';
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['slug'] = str($validatedForm['name'])->slug();
    $validatedForm['updated_by'] = auth()->user()->username;

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $masterData->update($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete()
  {
    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }
}
