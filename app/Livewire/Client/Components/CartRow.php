<?php

namespace App\Livewire\Client\Components;

use Livewire\Component;

class CartRow extends Component
{
    public $course;
    public $item;

    public function mount($item)
        {
        $this->$item = $item;
        $this->course = $item->course;
    }
    public function render()
    {
        return view('livewire.client.components.cart-row');
    }


    public function removeFromCart()
    {
        $this->dispatch('removeFromCart', $this->item->id);
    }
}
