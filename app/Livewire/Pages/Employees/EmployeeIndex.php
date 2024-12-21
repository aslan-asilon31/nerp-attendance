<?php

namespace App\Livewire\Pages\Employees;

use Livewire\Component;

class EmployeeIndex extends Component
{
  public function render()
  {
    return view('livewire.pages.employees.employee-index')
      ->title($this->title);
  }

  public string $title = 'Employees';
}
