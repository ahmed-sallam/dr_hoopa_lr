<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ClientCourse extends Component
{
    public function render()
    {
        return view('livewire.client.client-course')->layout('layouts.client');
    }
}
