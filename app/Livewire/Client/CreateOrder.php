<?php

namespace App\Livewire\Client;

use Livewire\Component;

class CreateOrder extends Component
{
    public function render()
    {
        return view('livewire.client.create-order')->layout('layouts.client');
    }
}
