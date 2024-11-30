<?php

namespace App\Livewire\Client\Components;

use Livewire\Component;
use App\Models\Course;

class CourseCard extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.client.components.course-card');
    }
}
