<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class SidebarMenu extends Component
{
  public function render()
  {
    return view('livewire.partials.sidebar-menu');
  }

  public function logout()
  {
    \Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
  }
}
