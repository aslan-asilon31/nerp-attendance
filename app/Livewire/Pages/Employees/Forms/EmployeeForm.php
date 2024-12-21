<?php

namespace App\Livewire\Pages\Employees\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeForm extends Form
{
  #[Validate('required')]
  public string|null $name = null;

  #[Validate('required')]
  public string|null $phone = null;

  #[Validate('required')]
  public string|null $email = null;

  #[Validate('required')]
  public string|null $image_url = null;

  #[Validate('required')]
  public int|null $is_activated = 1;

  #[Validate('required')]
  public string|null $position_id = null;
}
