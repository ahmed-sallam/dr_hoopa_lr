<?php

namespace App\Livewire\Client;

use Livewire\Component;

class UserProfile extends Component
{
    public function render()
    {
        return view('livewire.client.user-profile')->layout('layouts.client');
    }
}
