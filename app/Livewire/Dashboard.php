<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public string $title = 'الرئيسية';
    public string $logo = <<<'EOT'
    <svg class="w-8 h-8"
    viewBox="0 0 30 29"
    fill="currentColor"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M25.6691 9.67812L17.7545 3.34645C16.2079 2.11395 13.7912 2.10187 12.2566 3.33437L4.34205 9.67812C3.20622 10.5844 2.51746 12.3969 2.75913 13.8227L4.28163 22.9335C4.63205 24.9756 6.52913 26.5827 8.59538 26.5827H21.4037C23.4458 26.5827 25.3791 24.9394 25.7295 22.9215L27.252 13.8106C27.4695 12.3969 26.7808 10.5844 25.6691 9.67812ZM15.9058 21.7494C15.9058 22.2448 15.495 22.6556 14.9995 22.6556C14.5041 22.6556 14.0933 22.2448 14.0933 21.7494V18.1244C14.0933 17.629 14.5041 17.2181 14.9995 17.2181C15.495 17.2181 15.9058 17.629 15.9058 18.1244V21.7494Z"
        fill="currentColor" />
</svg>
EOT;

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app', [
            'title' => $this->title,
            'logo' => $this->logo,
        ]);
    }
}
