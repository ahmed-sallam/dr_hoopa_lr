<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Livewire\Forms\CourseForm;

class CreateCourse extends Component
{
    use WithFileUploads;

    public CourseForm $form;
    public $course = null;

    public function mount($parent_id, $course = null)
    {
        // $this->form = new CourseForm();
        $this->form->parent_id = $parent_id;
        if ($course) {
            $this->course=$course;
            $this->form->setCourse($course);
        }
    }

    public function save():void
    {
        if($this->course)
        {
            $this->form->update();
            session()->flash("message", "Course Updated successfully.");
        }else{
        $this->form->save();
        session()->flash("message", "Course created successfully.");
        }
        $this->dispatch("course-created");
        // return redirect()->route('courses.index');
    }

    public function addDataItem()
    {
        $this->form->addDataItem();
    }

    public function removeDataItem($index)
    {
        $this->form->removeDataItem($index);
    }

    public function render()
    {
        return view("livewire.courses.create-course");
    }

    #[On("reset-form")]
    public function resetForm()
    {
        $this->form->resetForm();
    }
}
