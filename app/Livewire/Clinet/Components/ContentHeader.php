<?php

namespace App\Livewire\Clinet\Components;

use Livewire\Component;

class ContentHeader extends Component
{
    public $content;
    public $currentChildrenView;


    public function render()
    {
        return view('livewire.clinet.components.content-header');
    }
}
