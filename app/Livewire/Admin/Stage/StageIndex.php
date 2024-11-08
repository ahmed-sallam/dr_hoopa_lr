<?php

namespace App\Livewire\Admin\Stage;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Stage;
use App\Livewire\Forms\StageForm;

class StageIndex extends Component
{
    use Toast;
    public string $title = "المراحل";
    public string $logo = <<<'EOT'
     <svg class="w-12 h-12" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M25.5 9.75H4.5C4.0875 9.75 3.75 9.4125 3.75 9C3.75 8.5875 4.0875 8.25 4.5 8.25H25.5C25.9125 8.25 26.25 8.5875 26.25 9C26.25 9.4125 25.9125 9.75 25.5 9.75Z" fill="currentColor"/>
        <path d="M21.75 16.5H8.25C7.8375 16.5 7.5 16.1625 7.5 15.75C7.5 15.3375 7.8375 15 8.25 15H21.75C22.1625 15 22.5 15.3375 22.5 15.75C22.5 16.1625 22.1625 16.5 21.75 16.5Z" fill="currentColor"/>
        <path d="M16.5 23.25H12C11.5875 23.25 11.25 22.9125 11.25 22.5C11.25 22.0875 11.5875 21.75 12 21.75H16.5C16.9125 21.75 17.25 22.0875 17.25 22.5C17.25 22.9125 16.9125 23.25 16.5 23.25Z" fill="currentColor"/>
    </svg>
EOT;

    public array $headers;
    public array $sortBy;
    public string $successMessage = '';
    public bool $showArchived = false;
    public bool $showFilterDrawer = false;
    public bool $showAddModal = false;
    public bool $showEditModal = false;
    public StageForm $form;
    public ?Stage $stageToEdit = null;

    public function mount()
    {
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'اسم المرحلة'],
            ['key' => 'notes', 'label' => 'ملاحظات'],
        ];

        $this->sortBy = ['column' => 'id', 'direction' => 'asc', 'class' => 'text-red-500'];
        $this->successMessage = __('success');
    }

    public function render()
    {
        return view('livewire.admin.stage.stage-index')->layout('layouts.admin', [
            "title" => $this->title,
            "logo" => $this->logo,
        ]);
    }

    public function stages()
    {
        return Stage::all();
    }

    public function save()
    {
        $this->form->store();
        $this->showAddModal = false;
        $this->success('تم إضافة المرحلة بنجاح');
    }

    public function edit(Stage $stage)
    {
        $this->stageToEdit = $stage;
        $this->form->setStage($stage);
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->form->update($this->stageToEdit);
        $this->showEditModal = false;
        $this->success('تم تحديث المرحلة بنجاح');
    }
}
