import "./bootstrap";
import "flowbite";

// import Alpine from "alpinejs";
import Plyr from "plyr";
import { initFlowbite } from "flowbite";


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

///////
// resources/js/app.js
// import './bootstrap';
// import Alpine from 'alpinejs';


// Register Alpine Data component


// window.Alpine = Alpine;
// Alpine.start();

////////
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

    // Alpine.data('videoPlayer', (initialUrl) => ({
    //     player: null,
    //     currentTime: 0,
    //
    //     init() {
    //         this.player = videojs(this.$refs.videoPlayer, {
    //             controls: true,
    //             autoplay: false,
    //             preload: 'auto',
    //             fluid: true,
    //             responsive: true,
    //             playbackRates: [0.5, 1, 1.5, 2],
    //             sources: [{
    //                 src: initialUrl,
    //                 type: 'video/mp4'
    //             }]
    //         });
    //
    //         this.player.on('error', () => {
    //             this.currentTime = this.player.currentTime();
    //             this.$wire.refreshUrl();
    //         });
    //
    //         window.Livewire.on('urlRefreshed', newUrl => {
    //             this.player.src({
    //                 src: newUrl,
    //                 type: 'video/mp4'
    //             });
    //
    //             this.player.load();
    //
    //             this.player.one('loadedmetadata', () => {
    //                 this.player.currentTime(this.currentTime);
    //                 this.player.play();
    //             });
    //         });
    //     },
    //
    //     // Cleanup on disconnect
    //     destroy() {
    //         if (this.player) {
    //             this.player.dispose();
    //         }
    //     }
    // }));

    Alpine.data('videoPlayer', (initialVideoUrl) => ({
        videoUrl: initialVideoUrl,
        player: null,

        initPlayer() {
            const options = {
                controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'],
                settings: ['quality', 'speed'],
                keyboard: { focused: true, global: true },
                tooltips: { controls: true, seek: true },
                quality: { default: 720, options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240] },
                speed: { selected: 1, options: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2] },
                youtube: {
                    noCookie: true,
                    rel: 0,
                    showinfo: 0,
                    iv_load_policy: 3,
                    modestbranding: 1
                }
            };

            // Initialize player
            this.player = new Plyr('#plyr-player', options);
            
            // Extract YouTube ID and set source
            const videoId = this.extractVideoId(this.videoUrl);
            if (videoId) {
                const iframe = this.$el.querySelector('iframe');
                iframe.src = `https://www.youtube.com/embed/${videoId}?origin=${window.location.origin}&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1`;
            }

            // Handle errors
            this.player.on('error', (error) => {
                console.error('Plyr error:', error);
            });
        },

        extractVideoId(url) {
            const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
            const match = url.match(regExp);
            return (match && match[7].length === 11) ? match[7] : null;
        },

        destroy() {
            if (this.player) {
                this.player.destroy();
            }
        }
    }));

// window.videojs = videojs;
//
//     Alpine.data('videoPlayer', (initialUrl) => ({
//         player: null,
//         currentTime: 0,
//
//         init() {
//             // Initialize the player
//             if (!this.player) {
//                 this.player = videojs(this.$refs.videoPlayer, {
//                     controls: true,
//                     autoplay: false,
//                     preload: 'none', // auto / none / metadata
//                     fluid: true,
//                     responsive: true,
//                     playbackRates: [0.5, 1, 1.5, 2],
//                     sources: [{
//                         src: initialUrl,
//                         type: 'video/mp4',
//                     }],
//                     enableSmoothSeeking: true,
//                     controlBar: {
//                         skipButtons: {
//                             forward: 5
//                         }
//                     },
//
//                 });
//
//                 this.player.on('error', () => {
//                     if (this.player) {
//                         this.currentTime = this.player.currentTime();
//                         this.$wire.refreshUrl();
//                     }
//                 });
//
//                 window.Livewire.on('urlRefreshed', newUrl => {
//                     if (this.player) {
//                         this.player.src({
//                             src: newUrl,
//                             type: 'video/mp4'
//                         });
//
//                         this.player.load();
//
//                         this.player.one('loadedmetadata', () => {
//                             this.player.currentTime(this.currentTime);
//                             this.player.play();
//                         });
//                     }
//                 });
//             }
//         },
//
//         destroy() {
//             if (this.player) {
//                 this.player.dispose();
//                 this.player = null;
//             }
//         }
//     }));
//

});

document.addEventListener('keydown', (e) => {
    if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
        e.preventDefault();
    }
});

document.addEventListener('contextmenu', e => e.preventDefault());
// https://rr2---sn-hgn7rn7y.googlevideo.com/videoplayback?expire=1730808316&ei=nLUpZ66aA6O7rtoPj5m3oQk&ip=36.255.248.122&id=o-ABJxENq3RWE1be9zZXEPKd3_jow0LOU07j0DtSHtxqNI&itag=18&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&bui=AQn3pFSEj4OIEy4OoZDKA7_VgQAo9Uoxu0MrrEm_PFGq2joWQbPHyoNonq-nM27t8lWExLIzPAnamxYh&spc=qtApAe8Lpm3v37cvRPwTgNwZ7CjAfQzbUKpcd9BQe32cHZ2HmwiCG-cmaQ&vprv=1&svpuc=1&mime=video%2Fmp4&ns=C5OljdskEf40P4aDodQ7OCMQ&rqh=1&gir=yes&clen=53917921&ratebypass=yes&dur=2961.356&lmt=1725840725247840&fexp=24350590,24350655,24350675,24350705,24350737,51312688,51326932,51331020&c=WEB&sefc=1&txp=5438434&n=rjG_8iyD-33ldw&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cxpc%2Cbui%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Crqh%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&sig=AJfQdSswRAIgTzv1UbLscPLHgB024-wqXcP1lRcIrBvMSJ6BF5yQy8sCIE6R_ufE1DjXac-Q6L7oi7lHZipA4VkLnxaABlQb553-&title=%D8%AA%D9%84%D8%A7%D9%88%D8%A7%D8%AA%20%D9%8A%D8%B9%D8%AC%D8%B2%20%D8%A7%D9%84%D9%84%D8%B3%D8%A7%D9%86%20%D8%B9%D9%86%20%D9%88%D8%B5%D9%81%20%D8%AC%D9%85%D8%A7%D9%84%D9%87%D8%A7%20!!%20%D9%84%D9%84%D8%B4%D9%8A%D8%AE%20%D9%87%D9%8A%D8%AB%D9%85%20%D8%A7%D9%84%D8%AF%D8%AE%D9%8A%D9%86%20%7C%20new%20tilawat%20quran%20best%20voice&rm=sn-8vguxmoxunva-cvhs7e,sn-cvhd77l&rrc=79,104&req_id=60d85d63d0a3ee&cmsv=e&rms=rdu,au&redirect_counter=2&cms_redirect=yes&ipbypass=yes&met=1730786728,&mh=xW&mip=81.24.144.29&mm=29&mn=sn-hgn7rn7y&ms=rdu&mt=1730786459&mv=m&mvi=2&pl=22&lsparams=ipbypass,met,mh,mip,mm,mn,ms,mv,mvi,pl,rms&lsig=ACJ0pHgwRAIgCYJgfFI4m0H9V6NZ_tVCy1qzi56eUEilCnb1E9X_ROQCIDCOYNMs7mqcpErKVs-zSRcHGEpoNzkemZNnhKhM0PYu

document.addEventListener('livewire:navigated', function () {
    const player = new Plyr('#player', {
        // Plyr options here
    });
    window.player = player;

    player.on('play', () => {
        Livewire.dispatch('audioPlayed');
    });

    player.on('pause', () => {
        Livewire.dispatch('audioPaused');
    });
});
