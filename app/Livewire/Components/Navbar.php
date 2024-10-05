<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public $title = "";
    public $logo = '';
    public function mount($title, $logo)
    {
        $this->title = $title;
        $this->logo = $logo;
    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
