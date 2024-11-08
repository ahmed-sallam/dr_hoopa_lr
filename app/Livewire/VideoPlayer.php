<?php

namespace App\Livewire;

use Livewire\Component;

class VideoPlayer extends Component
{
    public $videoUrl;
    
    public function mount($url = null)
    {
        // Set default video if none provided
        $this->videoUrl = $url ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
    }

    public function render()
    {
        return view('livewire.video-player');
    }
}
