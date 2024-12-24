<div class="relative">
    {{-- nvigation line --}}

    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <div
                class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-neutral">
            <a href="{{ route('admin.course.index') }}"
               wire:navigate
               class="cursor-pointer">الكورسات</a>
{{--            @foreach ($this->getFoldersTree() as $folder)--}}
{{--                <div>--}}
{{--                    <svg class="w-6 h-6 text-gray-800 dark:text-white"--}}
{{--                         aria-hidden="true"--}}
{{--                         xmlns="http://www.w3.org/2000/svg"--}}
{{--                         width="24"--}}
{{--                         height="24"--}}
{{--                         fill="none"--}}
{{--                         viewBox="0 0 24 24">--}}
{{--                        <path stroke="currentColor"--}}
{{--                              stroke-linecap="round"--}}
{{--                              stroke-linejoin="round"--}}
{{--                              stroke-width="2"--}}
{{--                              d="m10 16 4-4-4-4"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <a href="{{ route('admin.course.view', $folder->id) }}"--}}
{{--                   wire:navigate--}}
{{--                   class="cursor-pointer">{{ $folder->title }}</a>--}}
{{--            @endforeach--}}
        </div>
    </div>


    {{-- hero image --}}
    <div class="relative flex items-center justify-center mt-6 ">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        @if ($course && $course->thumbnail)
            <img src="{{ Storage::url($course->thumbnail) }}"
                 class="object-cover w-full h-56 "/>
        @else
            <img src="{{ asset('images/hero1.jpg') }}"
                 class="object-cover w-full h-56 "/>
        @endif
    </div>

    {{-- main contetn --}}
    <div
            class="grid w-full gap-4 mt-6 lg:grid-cols-12 lg:mt-10 relative pt-[100px] md:pt-[100px]">
        <livewire:clinet.components.content-header :content="$lesson"
                                                   :currentChildrenView="'view_lesson'"
                                                   :key="'view_lesson' . $lesson->id"/>


        {{-- full side --}}

        <div class="flex flex-col items-start justify-start gap-4 p-4
        lg:col-span-12">
            @if($lesson->content_type === 'video')
                @if($lesson->canBeViewedByUser(auth()->user()))
                    <div class="w-full aspect-video rounded-lg overflow-hidden">
                        <div class="plyr__video-embed" id="player">
                            <iframe
                                src="{{ $lesson->getSecureVideoUrl() }}"
                                allowfullscreen
                                allowtransparency
                                allow="autoplay"
                            ></iframe>
                        </div>
                    </div>
                @else
                    <div class="w-full aspect-video rounded-lg overflow-hidden bg-base-200 flex items-center justify-center">
                        <div class="text-center p-4">
                            <h3 class="text-xl font-bold mb-2">محتوى مقيد</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                هذا المحتوى متاح فقط للمشتركين في الدورة
                            </p>
                            @auth
                                <a wire:click="addToCart({{$lesson->course_id
                                 }})"
                                   class="btn btn-primary mt-4">
                                    اشترك الآن
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="btn btn-primary mt-4">
                                    سجل دخول للاشتراك
                                </a>
                            @endauth
                        </div>
                    </div>
                @endif
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const player = new Plyr('#player', {
                            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
                            settings: ['captions', 'quality', 'speed'],
                            youtube: { noCookie: true }
                        });
                    });
                </script>
            @elseif($lesson->content_type === 'quiz')
                <div class="w-full aspect-[4/3] rounded-lg overflow-hidden">
                    <iframe
                        class="w-full h-full"
                        src="{{ $lesson->content_url }}"
                        title="{{ $lesson->title }}"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                </div>
            @else
                <div class="w-full p-4 rounded-lg bg-base-200">
                    <p class="text-center text-gray-600 dark:text-gray-400">
                        المحتوى غير متاح حالياً
                    </p>
                </div>
            @endif

                <div class="flex items-center justify-center gap-2 mt-3 w-full">
                    <a href="#"
                       class="flex items-center gap-2 px-4 py-1 text-xs text-white rounded-md bg-primary dark:text-gray-800 dark:bg-white">
                        <svg class="w-6 h-6 "
                             xmlns="http://www.w3.org/2000/svg"
                             x="0px"
                             y="0px"
                             fill="currentColor"
                             viewBox="0 0 30 30">
                            <path
                                    d="M 25.154297 3.984375 C 24.829241 3.998716 24.526384 4.0933979 24.259766 4.2011719 C 24.010014 4.3016357 23.055766 4.7109106 21.552734 5.3554688 C 20.048394 6.0005882 18.056479 6.855779 15.931641 7.7695312 C 11.681964 9.5970359 6.9042108 11.654169 4.4570312 12.707031 C 4.3650097 12.746607 4.0439208 12.849183 3.703125 13.115234 C 3.3623292 13.381286 3 13.932585 3 14.546875 C 3 15.042215 3.2360676 15.534319 3.5332031 15.828125 C 3.8303386 16.121931 4.144747 16.267067 4.4140625 16.376953 C 5.3912284 16.775666 8.4218473 18.015862 8.9941406 18.25 C 9.195546 18.866983 10.29249 22.222526 10.546875 23.044922 C 10.714568 23.587626 10.874198 23.927519 11.082031 24.197266 C 11.185948 24.332139 11.306743 24.45034 11.453125 24.542969 C 11.511635 24.579989 11.575789 24.608506 11.640625 24.634766 L 11.644531 24.636719 C 11.659471 24.642719 11.67235 24.652903 11.6875 24.658203 C 11.716082 24.668202 11.735202 24.669403 11.773438 24.677734 C 11.925762 24.726927 12.079549 24.757812 12.216797 24.757812 C 12.80196 24.757814 13.160156 24.435547 13.160156 24.435547 L 13.181641 24.419922 L 16.191406 21.816406 L 19.841797 25.269531 C 19.893193 25.342209 20.372542 26 21.429688 26 C 22.057386 26 22.555319 25.685026 22.875 25.349609 C 23.194681 25.014192 23.393848 24.661807 23.478516 24.21875 L 23.478516 24.216797 C 23.557706 23.798129 26.921875 6.5273437 26.921875 6.5273438 L 26.916016 6.5507812 C 27.014496 6.1012683 27.040303 5.6826405 26.931641 5.2695312 C 26.822973 4.8564222 26.536648 4.4608905 26.181641 4.2480469 C 25.826669 4.0352506 25.479353 3.9700339 25.154297 3.984375 z M 24.966797 6.0742188 C 24.961997 6.1034038 24.970391 6.0887279 24.962891 6.1230469 L 24.960938 6.1347656 L 24.958984 6.1464844 C 24.958984 6.1464844 21.636486 23.196371 21.513672 23.845703 C 21.522658 23.796665 21.481573 23.894167 21.439453 23.953125 C 21.379901 23.91208 21.257812 23.859375 21.257812 23.859375 L 21.238281 23.837891 L 16.251953 19.121094 L 12.726562 22.167969 L 13.775391 17.96875 C 13.775391 17.96875 20.331562 11.182109 20.726562 10.787109 C 21.044563 10.471109 21.111328 10.360953 21.111328 10.251953 C 21.111328 10.105953 21.035234 10 20.865234 10 C 20.712234 10 20.506484 10.14875 20.396484 10.21875 C 18.963383 11.132295 12.671823 14.799141 9.8515625 16.439453 C 9.4033769 16.256034 6.2896636 14.981472 5.234375 14.550781 C 5.242365 14.547281 5.2397349 14.548522 5.2480469 14.544922 C 7.6958673 13.491784 12.47163 11.434667 16.720703 9.6074219 C 18.84524 8.6937992 20.838669 7.8379587 22.341797 7.1933594 C 23.821781 6.5586849 24.850125 6.1218894 24.966797 6.0742188 z">
                            </path>
                        </svg>
                        جروب التليجرام
                    </a>
                    <a href="#"
                       class="flex items-center gap-2 px-4 py-1 text-xs text-white rounded-md bg-primary dark:text-gray-800 dark:bg-white">
                        <svg class="w-6 h-6 "
                             xmlns="http://www.w3.org/2000/svg"
                             x="0px"
                             y="0px"
                             fill="currentColor"
                             viewBox="0 0 50 50">
                            <path
                                    d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z">
                            </path>
                        </svg>

                        جروب الفيسبوك
                    </a>
                </div>

                <div class="p-4 mt-4 space-y-2 rounded shadow bg-base-200
                w-full">
                    <p>{{ $course->instructor ? $course->instructor->first_name.' ' .$course->instructor->last_name : ''}}</p>
                    <p>الماده : {{ $course->category?->name }} </p>
                    <p> السنة الدراسية : {{ $course->stage?->name }} </p>
                    <div class="divider divider-primary dark:divider-neutral"></div>
                    <p>{{ $lesson->description }} </p>
                </div>

        </div>

    </div>
</div>
