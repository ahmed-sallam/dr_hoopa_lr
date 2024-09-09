<div class="relative">
    {{-- nvigation line --}}
    <div class="flex items-center justify-end gap-2">
        <div
            class="flex items-center gap-2 justify-start bg-gray-100 py-2 rounded-3xl dark:bg-gray-800 px-4 flex-1 flex-row-reverse">
            <div href="{{ route('course.index') }}" wire:navigate class="cursor-pointer">الكورسات</div>
            @foreach ($this->getFoldersTree() as $folder)
                <div><svg class="w-6
                h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m10 16 4-4-4-4" />
                    </svg>
                </div>
                <div wire:click="selectCourse({{ $folder->id }})" class="cursor-pointer">{{ $folder->title }}</div>
            @endforeach
        </div>
        {{-- Back Button --}}
        <div>
            @if ($course)
                <a href="{{ route('course.index') }}" wire:navigate class="">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 19-7-7 7-7" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
    {{-- hero image --}}
    {{-- add overlay above image --}}
    <div class="relative flex items-center justify-center mt-6 ">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        @if ($course && $course->thumbnail)
            <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-48 object-cover  " />
        @else
            <img src="{{ asset('images/hero1.jpg') }}" class="w-full h-48 object-cover  " />
        @endif
    </div>


    {{-- main contetn --}}
    <div class="grid lg:grid-cols-12 gap-4 mt-6 lg:mt-10 w-full">
        @if ($course)
            {{-- if course is selected --}}
            {{-- right side --}}
            <div class="lg:col-span-4 bg-gray-100 dark:bg-gray-800 rounded-lg p-3">
                {{-- rounded card for play youtube video --}}
                @if ($course->featured_video)
                    <div class="aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <iframe class="w-full h-full" src="{{ $course->featured_video }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
                {{-- tow buttons for facebook and telegram --}}
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <a href="#"
                        class="bg-gray-800 text-white  dark:text-gray-800 dark:bg-white  text-sm px-4 py-1 rounded-md flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" x="0px"
                            y="0px" viewBox="0 0 30 30">
                            <path
                                d="M 25.154297 3.984375 C 24.829241 3.998716 24.526384 4.0933979 24.259766 4.2011719 C 24.010014 4.3016357 23.055766 4.7109106 21.552734 5.3554688 C 20.048394 6.0005882 18.056479 6.855779 15.931641 7.7695312 C 11.681964 9.5970359 6.9042108 11.654169 4.4570312 12.707031 C 4.3650097 12.746607 4.0439208 12.849183 3.703125 13.115234 C 3.3623292 13.381286 3 13.932585 3 14.546875 C 3 15.042215 3.2360676 15.534319 3.5332031 15.828125 C 3.8303386 16.121931 4.144747 16.267067 4.4140625 16.376953 C 5.3912284 16.775666 8.4218473 18.015862 8.9941406 18.25 C 9.195546 18.866983 10.29249 22.222526 10.546875 23.044922 C 10.714568 23.587626 10.874198 23.927519 11.082031 24.197266 C 11.185948 24.332139 11.306743 24.45034 11.453125 24.542969 C 11.511635 24.579989 11.575789 24.608506 11.640625 24.634766 L 11.644531 24.636719 C 11.659471 24.642719 11.67235 24.652903 11.6875 24.658203 C 11.716082 24.668202 11.735202 24.669403 11.773438 24.677734 C 11.925762 24.726927 12.079549 24.757812 12.216797 24.757812 C 12.80196 24.757814 13.160156 24.435547 13.160156 24.435547 L 13.181641 24.419922 L 16.191406 21.816406 L 19.841797 25.269531 C 19.893193 25.342209 20.372542 26 21.429688 26 C 22.057386 26 22.555319 25.685026 22.875 25.349609 C 23.194681 25.014192 23.393848 24.661807 23.478516 24.21875 L 23.478516 24.216797 C 23.557706 23.798129 26.921875 6.5273437 26.921875 6.5273438 L 26.916016 6.5507812 C 27.014496 6.1012683 27.040303 5.6826405 26.931641 5.2695312 C 26.822973 4.8564222 26.536648 4.4608905 26.181641 4.2480469 C 25.826669 4.0352506 25.479353 3.9700339 25.154297 3.984375 z M 24.966797 6.0742188 C 24.961997 6.1034038 24.970391 6.0887279 24.962891 6.1230469 L 24.960938 6.1347656 L 24.958984 6.1464844 C 24.958984 6.1464844 21.636486 23.196371 21.513672 23.845703 C 21.522658 23.796665 21.481573 23.894167 21.439453 23.953125 C 21.379901 23.91208 21.257812 23.859375 21.257812 23.859375 L 21.238281 23.837891 L 16.251953 19.121094 L 12.726562 22.167969 L 13.775391 17.96875 C 13.775391 17.96875 20.331562 11.182109 20.726562 10.787109 C 21.044563 10.471109 21.111328 10.360953 21.111328 10.251953 C 21.111328 10.105953 21.035234 10 20.865234 10 C 20.712234 10 20.506484 10.14875 20.396484 10.21875 C 18.963383 11.132295 12.671823 14.799141 9.8515625 16.439453 C 9.4033769 16.256034 6.2896636 14.981472 5.234375 14.550781 C 5.242365 14.547281 5.2397349 14.548522 5.2480469 14.544922 C 7.6958673 13.491784 12.47163 11.434667 16.720703 9.6074219 C 18.84524 8.6937992 20.838669 7.8379587 22.341797 7.1933594 C 23.821781 6.5586849 24.850125 6.1218894 24.966797 6.0742188 z">
                            </path>
                        </svg>
                        جروبالتليجرام
                    </a>
                    <a href="#"
                        class="bg-gray-800 text-white  dark:text-gray-800 dark:bg-white  text-sm px-4 py-1 rounded-md flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" x="0px"
                            y="0px" viewBox="0 0 50 50">
                            <path
                                d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z">
                            </path>
                        </svg>

                        جروب الفيسبوك
                    </a>

                </div>
            </div>
        @endif

        {{-- left side --}}
        <div class="lg:col-span-8 p-4 gap-4 flex  flex-col items-start justify-start">
            @if ($isCreateCourse)
                <livewire:courses.create-course :parent_id="$course ? $course->id : null" />
            @elseif ($showContent)
                {{-- courses --}}
                @foreach ($courses as $mCourse)
                    <div
                        class="flex hover:scale-105  transition-all duration-300  flex-col md:flex-row items-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 w-full ">
                        <div class="md:w-1/3 h-full">
                            <img class="object-cover w-full h-full rounded-t-lg md:rounded-none md:rounded-s-lg "
                                src="{{ Storage::url($mCourse->thumbnail) }}" alt="Course Image">
                        </div>
                        <div class="flex flex-col justify-between items-start p-4 leading-normal md:w-2/3 h-full">
                            <div>

                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white cursor-pointer hover:text-primary hover:underline"
                                    wire:click="selectCourse({{ $mCourse->id }})">
                                    {{ $mCourse->title }}</h5>
                                {{-- sub stitle --}}
                                <h6 class="text-sm font-light ">{{ $mCourse->sub_title }}</h6>
                            </div>

                            <div class="grid grid-cols-3 w-full gap-1.5 text-xs font-light">
                                {{-- price and add to cart section --}}
                                <div
                                    class="col-span-2  border rounded-md border-b-gray-100 dark:border-gray-800 flex items-center justify-between gap-2 p-1">
                                    <div>
                                        <div class="flex items-center justify-start gap-2 ">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            @if ($mCourse->discount && $mCourse->discount > 0)
                                                <p>{{ $mCourse->net_price }} ج.م</p>
                                                <p class="line-through text-danger">{{ $mCourse->price }} ج.م</p>
                                            @else
                                                <p>{{ $mCourse->price }} ج.م</p>
                                            @endif

                                        </div>
                                        @if ($mCourse->discount && $mCourse->discount > 0)
                                            <div class="flex items-center justify-start gap-2 ">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4 2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                                                </svg>
                                                <p>توفير {{ ($mCourse->price * $mCourse->discount) / 100 }} ج.م</p>
                                                {{-- yello badg with  20% discount  --}}
                                                <span
                                                    class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-md flex items-center gap-1.5">
                                                    خصم {{ $mCourse->discount }}%
                                                </span>
                                            </div>
                                        @endif

                                    </div>
                                    {{-- btton add to cart with icon --}}
                                    <button
                                        class=" bg-primary/80 text-black text-xs px-4 py-1 rounded-md flex items-center gap-1.5">
                                        <svg class="w-6 h-6 text-black" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M5 3a1 1 0 0 0 0 2h.687L7.82 15.24A3 3 0 1 0 11.83 17h2.34A3 3 0 1 0 17 15H9.813l-.208-1h8.145a1 1 0 0 0 .979-.796l1.25-6A1 1 0 0 0 19 6h-2.268A2 2 0 0 1 15 9a2 2 0 1 1-4 0 2 2 0 0 1-1.732-3h-1.33L7.48 3.796A1 1 0 0 0 6.5 3H5Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M14 5a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 1 0 2 0V8h1a1 1 0 1 0 0-2h-1V5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        اضف الى المشتريات
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    @if ($showContent)
        {{-- addd button --}}
        <div class="flex items-center justify-center fixed bottom-10 left-36 z-20 ">
            <button type="button" data-dropdown-toggle="dropdownDistance" data-dropdown-offset-distance="35"
                data-dropdown-offset-skidding="0" aria-hidden="true"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
            hover:scale-105 transition-all duration-300 shadow-lg shadow-blue-500/20 ">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                <span class="sr-only">add course</span>
            </button>
        </div>
        <div id="dropdownDistance"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-28 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                <li>
                    <a wire:click="createCourse"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">اضف
                        كورس</a>
                </li>
                @if ($course)
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">اضف
                            فيديو</a>
                    </li>
                @endif

            </ul>
        </div>
    @endif

    @script
        <script>
            window.addEventListener('update-url', event => {
                const url = new URL(window.location);
                url.searchParams.set('course_id', event.detail.course_id);
                window.history.pushState({}, '', url);
            });
        </script>
    @endscript
</div>
