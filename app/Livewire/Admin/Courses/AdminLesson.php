<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Mary\Traits\Toast;

class AdminLesson extends Component
{
use Toast;
    public $courseId;
    public $lessonId;
    public $lesson;
    public $course;

    public function mount($courseId, $lessonId)
    {
        $this->courseId = $courseId;
        $this->lessonId = $lessonId;
        $this->lesson = $this->getLesson();
        $this->course = $this->getCourse();
    }


    public function render()
    {
        return view('livewire.admin.courses.admin-lesson')->layout('layouts.admin');
    }
    public function getLesson()
    {
        return Lesson::findOrFail($this->lessonId);
    }

    public function getCourse()
    {
        return Course::findOrFail($this->courseId);
    }
}
