<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AbandonedCartIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.abandoned-cart-index')->layout('layouts.finance');
    }
}
