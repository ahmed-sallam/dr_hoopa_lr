<?php

namespace App\Livewire\Courses\Components;

use App\Models\Lesson;
use Livewire\Component;
use Cohensive\OEmbed\Facades\OEmbed;
use Illuminate\Support\Facades\Crypt;


class ViewLessonVideo extends Component
{
    public Lesson $lesson;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function render()
    {
        $lesson = $this->lesson;
        $lesson->content_url = $this->getEmbedUrl($lesson->content_url);

        return view('livewire.courses.components.view-lesson-video', compact('lesson'));
    }

    public function getEmbedUrl($url)
    {
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
