<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Cache;

class UserIndex extends Component
{
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

    public string $selectedTab = '';
    public string $activeModal = '';
    public $permissions;
    public  $selectedRole =  null;


    public function mount()
    {
        $this->selectedTab = request()->query('query') ?? 'users';
        $this->permissions();
    }

    public function render()
    {
        return view('livewire.users.user-index', [
            'title' => $this->title,
            'logo' => $this->logo,
        ])->layout('layouts.app', ['title' => $this->title, 'logo' => $this->logo]);
    }

    public function users()
    {
        return User::all();
    }

    public function selectTab($tab)
    {
        $this->selectedTab = $tab;
        $this->setQueryParams($tab);
    }

    public function roles()
    {
        return Cache::remember('roles', 60 * 60, function () {
            return Role::all();
        });
    }

    public function permissions()
    {
        $this->permissions = Cache::remember('permissions', 60 * 60, function () {
            return Permission::all()->groupBy('table_name')->toArray();
        });
    }
    public function setQueryParams($query)
    {
        if ($query) {
            $this->dispatch('update-url', query: $query);
        }
    }

    public function selectRole($role)
    {
        $this->selectedRole = $role;
    }

    public function openModal($modal, $data = null)
    {
        $this->activeModal = $modal;
        if ($modal == 'role' && $data) {
            $this->selectedRole = $data;
        }
    }

    #[On('closeModal')]
    public function cancel()
    {
        $this->selectedRole = null;
        $this->activeModal = '';
    }
}
