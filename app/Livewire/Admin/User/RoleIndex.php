<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use Mary\Traits\Toast;
use Livewire\Component;

class RoleIndex extends Component
{
    use  Toast;

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
    public bool $showArchived = false;

    public $successMessage;


    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => __('id')],
            ['key' => 'name', 'label' => __('name')],
        ];
        $this->successMessage = __('success');
        // $this->permissions = Permission::all()->groupBy('table_name')->toArray();
    }


    public function render()
    {
        return view('livewire.admin.user.role-index')->layout('layouts.admin', [
            'title' => $this->title,
            'logo' => $this->logo
        ]);
    }

    public function roles()
    {
        return Role::all();
    }
}
