<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $darkMode;

    public function mount()
    {
        $this->darkMode = session('darkMode', false);
    }

    public function toggleTheme()
    {
        $this->darkMode = !$this->darkMode;
        session(['darkMode' => $this->darkMode]);
        $this->emit('darkModeToggled', $this->darkMode);
    }

    public function render()
    {
        return view('livewire.theme-toggle');
    }
}
