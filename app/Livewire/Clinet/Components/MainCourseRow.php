<?php

namespace App\Livewire\Clinet\Components;

use Livewire\Component;
use Mary\Traits\Toast;

class MainCourseRow extends Component
{
    use Toast;
    public $course;
    public function mount($course)
    {
        $this->course = $course;
    }
    public function render()
    {
        return view('livewire.clinet.components.main-course-row');
    }

    public function addToCart(): void
    {
//        $this->dispatch('addToCart', $this->course->id);
        $cart = auth()->user()->cart->where('course_id', $this->course->id)->first();
        if (!$cart) {
            \App\Models\Cart::create([
                'course_id' => $this->course->id,
                'user_id' => auth()->id(),
            ]);
            $this->success('تمت إضافة الكورس إلى سلة المشتريات');
        } else {
            $this->warning('الكورس موجود بالفعل في سلة المشتريات');
        }


    }
}
