<?php

namespace App\Livewire\Clinet\Components;

use App\Models\Course;
use Livewire\Component;

class CourseRow extends Component
{
    public Course $course;

    public function render()
    {
        return view('livewire.clinet.components.course-row');
    }
}
