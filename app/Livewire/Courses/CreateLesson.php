<?php

namespace App\Livewire\Courses;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\LessonForm;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateLesson extends Component
{
    use WithFileUploads;
    public LessonForm $form;
    public ?Lesson $lesson = null;
    public function mount($course_id, $lesson = null)
    {
        $this->form->course_id = $course_id;
        if ($lesson) {
            $this->lesson = $lesson;
            $this->form->setLesson($lesson);
        }
    }
    public function render()
    {
        return view('livewire.courses.create-lesson');
    }
    public function save()
    {
        if ($this->lesson) {
            $this->form->update();
            session()->flash('message', 'Lesson Updated successfully.');
        } else {
            $this->form->save();
            session()->flash('message', 'Lesson created successfully.');
        }
        $this->dispatch('lesson-saved');
    }

    public function addDataItem()
    {
        $this->form->addNewData();
    }
    public function removeDataItem($index)
    {
        $this->form->removeDataItem($index);
    }

    #[On("reset-form")]
    public function resetForm()
    {
        $this->form->reset();
    }
}
