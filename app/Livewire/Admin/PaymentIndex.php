<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PaymentIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.payment-index')->layout('layouts.finance');
    }
}
