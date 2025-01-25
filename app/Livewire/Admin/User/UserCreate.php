<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use Livewire\Attributes\On;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Livewire\Forms\UserForm;

class UserCreate extends Component
{
    use Toast;

    public UserForm $form;
    public bool $showModal = false;

    #[On('show-user-create-modal')]
    public function showModal()
    {
        $this->showModal = true;
    }
    #[On('hide-user-create-modal')]
    public function hideModal()
    {
        $this->showModal = false;
    }

    public function save(): void
    {
            $this->form->store();
            $this->showModal = false;
            $this->success('تم إضافة المستخدم بنجاح');
            $this->dispatch('user-created');
    }

    public function render()
    {
        return view('livewire.admin.user.user-create', [
            'roles' => Role::all()
        ]);
    }
}
