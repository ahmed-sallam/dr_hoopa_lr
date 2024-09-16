import "./bootstrap";
import "flowbite";

// import Alpine from "alpinejs";
import { initFlowbite } from "flowbite";

// window.Alpine = Alpine;

// document.addEventListener('alpine:init', () => {
// Alpine.store("darkMode", {
//     on: false,
//     init() {
//         this.on = localStorage.getItem("darkMode") === "true";
//         console.log(this.on);
//     },
//     toggle() {
//         console.log(this.on);
//         this.on = !this.on;
//         localStorage.setItem("darkMode", JSON.stringify(this.on));
//     },
// });
// });
// Initialize Flowbite when the page loads
// document.addEventListener('DOMContentLoaded', function () {
//     initFlowbite();
// });

// document.addEventListener('livewire:navigated', () => {
//     initFlowbite();
// });
document.addEventListener("livewire:load", () => {
    initFlowbite();
});
// Alpine.start();
