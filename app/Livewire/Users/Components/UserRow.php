<?php

namespace App\Livewire\Users\Components;

use App\Models\User;
use Livewire\Component;

class UserRow extends Component
{
    public User $user;
    public function render()
    {
        return view('livewire.users.components.user-row');
    }
}
