{{--<div>--}}
{{--    <div--}}
{{--            x-data="videoPlayer('{{ $streamUrl }}')"--}}
{{--            x-init="initPlayer"--}}
{{--            wire:ignore--}}
{{--            class="video-container"--}}
{{--    >--}}
{{--        <h2 class="text-xl font-bold mb-4">{{ "title" }}</h2>--}}

{{--        <video--}}
{{--                x-ref="videoPlayer"--}}
{{--                class="video-js vjs-default-skin vjs-big-play-centered"--}}
{{--                controls--}}
{{--                controlsList="nodownload"--}}
{{--                oncontextmenu="return false;"--}}
{{--                style="width: 100%; height: auto;"--}}
{{--        >--}}
{{--        </video>--}}


{{--    </div>--}}
{{--</div>--}}

{{--@push('styles')--}}
{{--    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />--}}
{{--    <style>--}}
{{--        .video-container {--}}
{{--            max-width: 1000px;--}}
{{--            margin: 0 auto;--}}
{{--            padding: 20px;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}

{{--@push('scripts')--}}
{{--    <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>--}}
{{--    <script>--}}
{{--        function videoPlayer(initialUrl) {--}}
{{--            return {--}}
{{--                player: null,--}}
{{--                currentTime: 0,--}}

{{--                initPlayer() {--}}
{{--                    this.player = videojs(this.$refs.videoPlayer, {--}}
{{--                        controls: true,--}}
{{--                        autoplay: false,--}}
{{--                        preload: 'auto',--}}
{{--                        fluid: true,--}}
{{--                        responsive: true,--}}
{{--                        playbackRates: [0.5, 1, 1.5, 2],--}}
{{--                        sources: [{--}}
{{--                            src: initialUrl,--}}
{{--                            type: 'video/mp4'--}}
{{--                        }]--}}
{{--                    });--}}

{{--                    this.player.on('error', () => {--}}
{{--                        this.currentTime = this.player.currentTime();--}}
{{--                    @this.refreshUrl();--}}
{{--                    });--}}

{{--                    window.Livewire.on('urlRefreshed', newUrl => {--}}
{{--                        this.player.src({--}}
{{--                            src: newUrl,--}}
{{--                            type: 'video/mp4'--}}
{{--                        });--}}

{{--                        this.player.load();--}}

{{--                        this.player.one('loadedmetadata', () => {--}}
{{--                            this.player.currentTime(this.currentTime);--}}
{{--                            this.player.play();--}}
{{--                        });--}}
{{--                    });--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        // Security measures--}}
{{--        document.addEventListener('keydown', (e) => {--}}
{{--            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {--}}
{{--                e.preventDefault();--}}
{{--            }--}}
{{--        });--}}

{{--        document.addEventListener('contextmenu', e => e.preventDefault());--}}
{{--    </script>--}}
{{--@endpush--}}

<!-- resources/views/livewire/video-player.blade.php -->
{{--<div>--}}
{{--    <div--}}
{{--            x-data="videoPlayer('{{ $streamUrl }}')"--}}
{{--            x-init="init"--}}
{{--            @disconnect.window="destroy"--}}
{{--            wire:ignore--}}
{{--            class="video-container"--}}
{{--    >--}}
{{--        <h2 class="text-xl font-bold mb-4">{{ "title" }}</h2>--}}

{{--        <video--}}
{{--                x-ref="videoPlayer"--}}
{{--                class="video-js vjs-default-skin vjs-big-play-centered"--}}
{{--                controls--}}
{{--                controlsList="nodownload"--}}
{{--                oncontextmenu="return false;"--}}
{{--                style="width: 100%; height: auto;"--}}
{{--        >--}}
{{--        </video>--}}


{{--    </div>--}}
{{--    --}}
{{--    --}}

{{--@assets--}}
{{--    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />--}}
{{--@endassets--}}

{{--</div>--}}

<div>
    <div x-data="videoPlayer('{{ $videoUrl }}')"
         x-init="initPlayer"
         wire:ignore
         class="video-container">
        
        <div class="plyr__video-embed" id="plyr-player">
            <iframe
                src="about:blank"
                allowfullscreen
                allowtransparency
                allow="autoplay"
            ></iframe>
        </div>
    </div>

    @assets
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
        <style>
            .video-container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
            }
            .plyr {
                border-radius: 8px;
                overflow: hidden;
            }
        </style>
    @endassets
</div>
