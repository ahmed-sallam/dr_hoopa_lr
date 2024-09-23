<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class RoleForm extends Form
{
    public ?Role $role = null;
    public string $name = '';
    public array $permissions = [];

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->role?->id),

            ],
        ];
    }

    public function store(): void
    {
        $this->validate();
        $role =  Role::create(['name' => $this->name]);
        $role->permissions()->attach(array_keys($this->permissions));
    }

    public function update(): void
    {
        $this->validate();
        $this->role->update(['name' => $this->name]);
        $this->permissions = array_filter($this->permissions, function ($value) {
            return $value === true;
        });

        $this->role->permissions()->sync(array_keys($this->permissions));
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = $role->permissions->mapWithKeys(function ($permission) {
            return [$permission->id => true];
        })->toArray();
    }
}
