<?php

namespace App\Livewire\Courses\Components;

use Livewire\Component;

class ContentHeader extends Component
{
    public $content;
    public $currentChildrenView;
    public function render()
    {
        return view('livewire.courses.components.content-header');
    }
}
