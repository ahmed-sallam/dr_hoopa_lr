<?php

namespace App\Livewire\Client\Components;

use App\Models\Course;
use Livewire\Component;

class CourseRow extends Component
{
    public Course $course;

    public function render()
    {
        return view('livewire.client.components.course-row');
    }

    public function addToCart(): void
    {
        $this->dispatch('addToCart', $this->course->id);
    }


}
