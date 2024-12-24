<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Attributes\On;
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


    #[On('deleteLesson')]
    public function deleteLesson($id)
    {
        $this->lesson->delete();
        $this->success('تم حذف الدرس بنجاح');
        return redirect()->route('admin.course.view', $this->courseId);
    }

    public function getFoldersTree()
    {
        if ($this->course == null) {
            return [];
        }

        $tree = $this->course->parentsArray();
        $tree[] = $this->course;

        return $tree;
    }
}
