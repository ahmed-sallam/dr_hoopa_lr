<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\UserForm;

class UserEdit extends Component
{
    use Toast;
    use WithFileUploads;


    public UserForm $form;
    public $user;
    public function mount($id)
    {
        $this->user = $this->getUser($id);
        $this->form->setUserData($this->user);
    }

    public function render()
    {
        return view('livewire.admin.user.user-edit')->layout('layouts.admin');
    }
    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function resetForm()
    {
        $this->form->setUserData($this->user);
    }


    public function save()
    {
        $this->form->update();
        $this->success('User updated successfully');
        return $this->redirect(route('admin.user.view', $this->user->id), true);
        // $this->dispatch('goBack');
    }
}
