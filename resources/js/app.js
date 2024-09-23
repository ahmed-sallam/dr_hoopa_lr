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
document.addEventListener("DOMContentLoaded", function () {
    initFlowbite();
});

document.addEventListener("livewire:navigated", () => {
    initFlowbite();
});
document.addEventListener("livewire:load", () => {
    initFlowbite();
});
// Alpine.start();

document.addEventListener("alpine:init", () => {
    // Define the 'darkMode' store
    Alpine.store("darkMode", {
        on: false, // Default value
        init() {
            this.on = localStorage.getItem("darkMode") === "true";
        },
        toggle() {
            this.on = !this.on;
            localStorage.setItem("darkMode", JSON.stringify(this.on));
        },
    });

    // Define the 'courses' store
    Alpine.store("courses", {
        showContent: true,
        isCreateCourse: false,
        setShowContent(value) {
            this.showContent = value;
            console.log("setShowContent", value);
        },
        setIsCreateCourse(value) {
            this.isCreateCourse = value;
            console.log("setIsCreateCourse", value);
        },
        reset() {
            this.showContent = true;
            this.isCreateCourse = false;
        },
    });
});
