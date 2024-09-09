<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

class CourseIndex extends Component
{
    public string $title = 'الكورسات';
    public string $logo = 'images/courses.png';
    public Collection $courses;
    public ?Course $course = null;

    public bool $isCreateCourse = false;
    public bool $showContent = true;

    public function mount()
    {
        $selectedCourseId = request()->query('course_id');
        $this->course = $selectedCourseId ? Course::find($selectedCourseId) : null;

        // Order by id and get only parent courses
        // $this->courses = Course::where('parent_id', null)->orderBy('id', 'desc')->get();
        $this->selectCourse($this->course);

        // $this->createCourse();
    }

    public function render()
    {
        return view('livewire.courses.course-index', [
            'title' => $this->title,
            'logo' => $this->logo,
            'courses' => $this->courses,
            'course' => $this->course,
        ])->layout('layouts.app'); // Specify the layout directly here
    }

    public function selectCourse(?Course $course = null)
    {
        $this->course = $course;

        // Update the query parameters
        $this->setQueryParams($course ? $course->id : null);

        if ($course == null) {
            $this->courses = Course::where('parent_id', null)->orderBy('id', 'desc')->get();
        } else {
            $this->courses = $this->course->children;
        }
    }

    protected function setQueryParams($courseId)
    {
        if ($courseId) {
            $this->dispatch('update-url', course_id: $courseId);
        }
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

    public function createCourse()
    {
        $this->isCreateCourse = true;
        $this->showContent = false;
    }

    #[On('course-created')]
    public function courseCreated()
    {
        $this->isCreateCourse = false;
        $this->showContent = true;
        $this->dispatch('reset-form');
    }
}
