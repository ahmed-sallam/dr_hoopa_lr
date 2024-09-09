<?php

namespace App\Livewire\Courses\Components;

use App\Models\Course;
use Livewire\Component;

class CourseRow extends Component
{
    public Course $course;

    public function render()
    {
        return view('livewire.courses.components.course-row');
    }
}
