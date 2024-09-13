import './bootstrap';
import 'flowbite';
import {initFlowbite} from 'flowbite';

// Initialize Flowbite when the page loads
document.addEventListener('DOMContentLoaded', function () {
    initFlowbite();
});

// Re-initialize Flowbite after Livewire updates
document.addEventListener('livewire:navigated', () => {
    initFlowbite();
});

// // Optional: Re-initialize Flowbite after Livewire updates (for older Livewire versions)
// document.addEventListener('livewire:load', () => {
//     Livewire.hook('message.processed', () => {
//         initFlowbite();
//     });
// });

Alpine.store('darkMode', {
    on: false,
    init() {
        this.on = localStorage.getItem('darkMode') === 'true';
    },
    toggle() {
        console.log(this.on)
        this.on = !this.on
        localStorage.setItem('darkMode', this.on);
    }
})

// Alpine.start()
