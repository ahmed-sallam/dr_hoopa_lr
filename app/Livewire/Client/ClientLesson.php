<?php

namespace App\Livewire\Client;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Mary\Traits\Toast;

class ClientLesson extends Component
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
    public function addToCart(int $courseId): void
    {
        $cart = auth()->user()->cart->where('course_id', $courseId)->first();
        if (!$cart) {
            $cart = \App\Models\Cart::create([
                'course_id' => $courseId,
                'user_id' => auth()->id(),
            ]);
            $this->success('تمت إضافة الكورس إلى سلة المشتريات');

        } else {
            $this->warning('الكورس موجود بالفعل في سلة المشتريات');
        }
    }
}
