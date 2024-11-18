<?php

namespace App\Livewire\Clinet\Components;

use Livewire\Component;

class MainCourseRow extends Component
{
    public $course;
    public function mount($course)
    {
        $this->course = $course;
    }
    public function render()
    {
        return view('livewire.clinet.components.main-course-row');
    }

    public function addToCart(): void
    {
        $this->dispatch('addToCart', $this->course->id);
    }
}
