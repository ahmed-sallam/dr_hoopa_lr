<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?string $name = '';

    public function store(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::create($validated);

        $this->reset();
    }

    public function setCategory(Category $category): void
    {
        $this->name = $category->name;
    }

    public function update(Category $category): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($validated);

        $this->reset();
    }
}
