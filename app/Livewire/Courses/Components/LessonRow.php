<?php

namespace App\Livewire\Courses\Components;

use App\Models\Lesson;
use Livewire\Component;

class LessonRow extends Component
{
    public Lesson $lesson;
    public function render()
    {
        return view('livewire.courses.components.lesson-row');
    }
}
