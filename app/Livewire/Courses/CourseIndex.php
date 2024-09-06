<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class CourseIndex extends Component
{
    public string $title = 'الكورسات';
    public string $logo = 'images/courses.png';
    public Collection $courses;
    public ?Course $course = null;
    public $layout = 'layouts.app';

    public function mount()
    {
        // order by id and get only parent courses
        $this->courses = Course::where('parent_id', null)->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.courses.course-index', [
            'title' => $this->title,
            'logo' => $this->logo,
            'courses' => $this->courses,
            'course' => $this->course
        ])->layout($this->layout);
    }

    public function selectCourse(Course $course)
    {
        $this->course = $course;
        if ($course == null) {
            $this->courses = Course::where('parent_id', null)->orderBy('id', 'desc')->get();
        } else {
            $this->courses = $this->course->children;
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
}
