<?php

namespace App\Livewire\Forms;

use App\Models\Stage;
use Livewire\Form;

class StageForm extends Form
{
    public ?string $name = '';
    public ?string $notes = '';

    public function store(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        Stage::create($validated);

        $this->reset();
    }

    public function setStage(Stage $stage): void
    {
        $this->name = $stage->name;
        $this->notes = $stage->notes;
    }

    public function update(Stage $stage): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $stage->update($validated);

        $this->reset();
    }
}
