<?php

namespace App\Livewire\Courses\Components;

use App\Models\Lesson;
use Livewire\Component;

class ViewLessonVideo extends Component
{
    public Lesson $lesson;

    public function render()
    {
        $this->lesson->content_url = $this->getEmbedUrl($this->lesson->content_url);
        return view('livewire.courses.components.view-lesson-video');
    }

    public function getEmbedUrl($url)
    {
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
