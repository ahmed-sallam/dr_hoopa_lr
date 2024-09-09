<?php

namespace App\Livewire\Users\Components;

use App\Models\Role;
use Livewire\Component;

class RoleRow extends Component
{
    public Role $role;
    public function render()
    {
        return view('livewire.users.components.role-row');
    }
}
