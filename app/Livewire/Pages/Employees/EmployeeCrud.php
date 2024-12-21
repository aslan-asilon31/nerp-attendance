<?php

namespace App\Livewire\Pages\Employees;

use App\Livewire\Pages\Employees\Forms\EmployeeForm;
use App\Models\Position;
use Livewire\Component;

class EmployeeCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.employees.employee-crud')
      ->title($this->title);
  }

  public string $title = 'Employees (CRUD)';

  public array $options = [];
  public function mount()
  {
    $this->options['positions'] = Position::get(['id', 'name'])->toArray();
  }

  public EmployeeForm $employeeForm;

  public function store()
  {
    dd('store');
  }
}
