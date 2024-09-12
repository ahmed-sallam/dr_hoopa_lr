<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;

class UserIndex extends Component
{
    public string $title = 'المستخدمين';
    public string $logo = 'images/users.png';
    public string $selectedTab = '';

    public function mount()
    {
        $this->selectedTab = request()->query('query') ?? 'users';
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
        return Role::all();
    }

    public function permissions()
    {
        return Permission::all()->groupBy('table_name')->toArray();
    }
    public function setQueryParams($query)
    {
        if ($query) {
            $this->dispatch('update-url', query: $query);
        }
    }
}
