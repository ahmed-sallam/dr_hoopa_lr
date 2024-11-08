<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\Permission;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Livewire\Forms\RoleForm;

class RoleIndex extends Component
{
    use Toast;

    public string $title = 'المستخدمين';
    public string $logo = <<<'EOT'
 <svg xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="w-12 h-12 ">
                            <path d="M18 21a8 8 0 0 0-16 0"/>
                            <circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
EOT;

    public array $headers;
    public array $sortBy;
    public bool $showArchived = false;
    public bool $showAddModal = false;
    public bool $showEditModal = false;
    public RoleForm $form;
    public ?Role $roleToEdit = null;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'اسم الدور'],
        ];
        $this->sortBy = ['column' => 'id', 'direction' => 'asc'];
    }

    public function render()
    {
        $groupedPermissions = Permission::all()->groupBy('table_name');
        
        return view('livewire.admin.user.role-index', [
            'groupedPermissions' => $groupedPermissions
        ])->layout('layouts.admin', [
            'title' => $this->title,
            'logo' => $this->logo
        ]);
    }

    public function roles()
    {
        return Role::all();
    }

    public function save()
    {
        $this->form->store();
        $this->showAddModal = false;
        $this->success('تم إضافة الدور بنجاح');
    }

    public function edit(Role $role)
    {
        $this->roleToEdit = $role;
        $this->form->setRole($role);
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->form->update();
        $this->showEditModal = false;
        $this->success('تم تحديث الدور بنجاح');
    }
}
