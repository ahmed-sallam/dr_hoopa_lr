<li class="flex items-center justify-center">
    <button wire:click="toggleTheme"
        class="w-28 flex items-center justify-center flex-col p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        @if ($darkMode)
            <img src="{{ asset('images/light-mode.png') }}" class="w-8 h-8" alt="Light Mode" />
            <p>وضع النهار</p>
        @else
            <img src="{{ asset('images/dark-mode.png') }}" class="w-8 h-8" alt="Dark Mode" />
            <p>وضع الليل</p>
        @endif
    </button>
</li>
