<?php

namespace App\Livewire\Users\Components;

use App\Models\Role;
use Livewire\Component;
use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Facades\Cache;

class RoleModal extends Component
{
    public RoleForm $form;

    public  $role;
    public $permissions;
    public $editMode = false;

    public function mount($permissions, $role)
    {
        $this->permissions = $permissions;
        if ($role) {
            $r = Role::find($role['id']);
            $this->editMode = true;
            $this->form->setRole($r);
            $this->role = $r;
        }
    }


    public function render()
    {
        return view('livewire.users.components.role-modal');
    }


    public function save(): void
    {
        if ($this->editMode) {
            // $this->authorize('update', $this->form->role);
            $this->form->update();
        } else {
            // $this->authorize('create', Role::class);
            $this->form->store();
        }
        Cache::forget('roles');
        Cache::forget('permissions');
        $this->dispatch('closeModal');
    }
}
