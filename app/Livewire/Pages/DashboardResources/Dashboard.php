<?php

namespace App\Livewire\Pages\DashboardResources;

use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
  public function render()
  {
    return view('livewire.pages.dashboard-resources.dashboard')
      ->title($this->title);
  }

  public $title = 'Dashboard';

  use WithFileUploads;

  public $image;
}
