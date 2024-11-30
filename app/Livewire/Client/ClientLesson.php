<?php

namespace App\Livewire\Client;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class ClientLesson extends Component
{
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
        return view('livewire.client.client-lesson')->layout('layouts.client');
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
