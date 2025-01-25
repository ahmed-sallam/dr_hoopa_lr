<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

class CourseIndex extends Component
{
    public string $title = "الكورسات";
    public string $logo = <<<'EOT'
     <svg class="w-12 h-12 "
                             viewBox="0 0 30 30" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.0379 19.5502C21.8754 19.0002 22.9754
                             19.6002 22.9754 20.6002V22.2127C22.9754 23.8002
                             21.7379 25.5002 20.2504 26.0002L16.2629 27.3252C15.5629 27.5627 14.4254 27.5627 13.7379 27.3252L9.75039 26.0002C8.25039 25.5002 7.02539 23.8002 7.02539 22.2127V20.5877C7.02539 19.6002
                             8.12539 19.0002 8.95039 19.5377L11.5254 21.2127C12.5129
                             21.8752 13.7629 22.2002 15.0129 22.2002C16.2629 22.2002 17.5129 21.8752 18.5004 21.2127L21.0379 19.5502Z" fill="currentColor"/>
                            <path d="M24.9754 8.07422L17.4879 3.16172C16.1379
                             2.27422 13.9129 2.27422 12.5629 3.16172L5.03789
                             8.07422C2.62539 9.63672 2.62539 13.1742 5.03789
                             14.7492L7.03789 16.0492L12.5629 19.6492C13.9129
                             20.5367 16.1379 20.5367 17.4879 19.6492L22.9754
                             16.0492L24.6879 14.9242V18.7492C24.6879 19.2617
                             25.1129 19.6867 25.6254 19.6867C26.1379 19.6867 26.5629 19.2617 26.5629 18.7492V12.5992C27.0629 10.9867 26.5504 9.11172 24.9754 8.07422Z" fill="currentColor"/>
                        </svg>
EOT;

    public Collection $courses;
    public Collection $lessons;
    public ?Course $course = null;
    public ?Lesson $lesson = null;

    public array $availableChldrenViews = [
        'main_courses',
        'one_course',
        'view_lesson',
        'create_course',
        'edite_course',
        'edit_lesson',
        'create_lesson'
    ];

    public string $currentChildrenView = '';

    public function mount()
    {
        $selectedCourseId = request()->query("course_id");
        $this->currentChildrenView = request()->query("view") ?? 'main_courses';
        $lesson = request()->query("lesson_id");

        if ($lesson) {
            $this->lesson = Lesson::find($lesson);
        }
        $this->course = $selectedCourseId ? Course::with('children', 'lessons')->find($selectedCourseId) : null;

        // Order by id and get only parent courses
        $this->selectCourse($this->course);

    }

    public function render()
    {
        return view("livewire.courses.course-index")->layout("layouts.admin", [
            "title" => $this->title,
            "logo" => $this->logo,
        ]);
    }

    public function selectCourse(?Course $course = null)
    {
        $this->cancel();

        $this->course = $course;

        // Update the query parameters
        $this->setQueryParams($course ? $course->id : null);

        if ($course == null) {
            $this->courses = Course::where("parent_id", null)
                ->orderBy("id", "desc")
                ->get();
            // $this->selectChildrenView("main_courses");
        } else {
            $this->courses = $this->course->children;
            // $this->selectChildrenView("one_course");
        }
    }


    protected function setQueryParams($courseId)
    {
        if ($courseId) {
            $this->dispatch("update-url", course_id: $courseId);
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



    #[On("course-created")]
    #[On("lesson-saved")]
    public function courseCreated()
    {
        $this->selectCourse($this->course);
        $this->cancel();
    }

    public function cancel()
    {
        $this->dispatch("reset-form");
        $this->selectChildrenView('one_course');
    }

    public function deleteCourse()
    {
        $children = $this->course->children;

        if ($children->count() == 0) {
            $this->course->delete();
            $this->goBackCourse();
        }
    }

    public function goBackCourse()
    {
        $treeCount = count($this->getFoldersTree());
        if ($treeCount > 1) {
            $this->selectCourse($this->getFoldersTree()[$treeCount - 2]);
        } else {
            $this->selectCourse(null);
        }
    }

    public function selectChildrenView(string $view, $lesson = null)
    {
        $this->currentChildrenView = $view;
        $this->dispatch("update-url", view: $view);
        if ($lesson != null) {
            $this->lesson = Lesson::find($lesson);
            $this->dispatch("update-url", lesson_id: $lesson);
        }
    }
}
