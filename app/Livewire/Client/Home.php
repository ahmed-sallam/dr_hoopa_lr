<?php

namespace App\Livewire\Client;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.client.home')->layout('layouts.client');
    }
}
