<div>
<div class="relative">

    {{-- nvigation line --}}
    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <x-mary-dropdown>
            <x-slot:trigger>
                <div
                        class="flex items-center h-10 gap-2 px-4 py-3 rounded-full w-28 btn-primary dark:text-base-300 dark:bg-white btn-sm btn">
                    <svg class="h-4 font-semibold"
                         viewBox="0 0 4 19"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M1.81732 1.96003C2.36953 1.96003 2.81719 2.40768 2.81719 2.9599C2.81719 3.51211 2.36953 3.95977 1.81732 3.95977C1.26511 3.95977 0.817449 3.51211 0.817449 2.9599C0.817449 2.40768 1.26511 1.96003 1.81732 1.96003ZM1.81732 8.24493C2.36953 8.24493 2.81719 8.69259 2.81719 9.2448C2.81719 9.79702 2.36953 10.2447 1.81732 10.2447C1.26511 10.2447 0.81745 9.79702 0.81745 9.2448C0.81745 8.69259 1.26511 8.24493 1.81732 8.24493ZM1.81732 14.5298C2.36953 14.5298 2.81719 14.9775 2.81719 15.5297C2.81719 16.0819 2.36954 16.5296 1.81732 16.5296C1.26511 16.5296 0.81745 16.0819 0.81745 15.5297C0.81745 14.9775 1.26511 14.5298 1.81732 14.5298Z"
                                fill="currentColor"
                                stroke="currentColor"
                                stroke-width="1.14271" />
                    </svg>
                    المزيد
                </div>
            </x-slot:trigger>
            <x-mary-menu-item title="الاقسام"
                              href="{{ route('admin.category.index') }}"
                              wire:navigate
                              class="text-primary" />
            <x-mary-menu-item title="المراحل"
                              href="{{ route('admin.stage.index') }}"
                              wire:navigate
                              class="text-primary" />
        </x-mary-dropdown>
        <div
                class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-dark">
            <a href="{{ route('admin.course.index') }}"
               wire:navigate
               class="cursor-pointer">الكورسات</a>
{{--            @foreach ($this->getFoldersTree() as $folder)--}}
{{--                <div><svg class="w-6 h-6 text-gray-800 dark:text-white"--}}
{{--                          aria-hidden="true"--}}
{{--                          xmlns="http://www.w3.org/2000/svg"--}}
{{--                          width="24"--}}
{{--                          height="24"--}}
{{--                          fill="none"--}}
{{--                          viewBox="0 0 24 24">--}}
{{--                        <path stroke="currentColor"--}}
{{--                              stroke-linecap="round"--}}
{{--                              stroke-linejoin="round"--}}
{{--                              stroke-width="2"--}}
{{--                              d="m10 16 4-4-4-4" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <div wire:click="selectCourse({{ $folder->id }})"--}}
{{--                     @click="$store.courses.reset()"--}}
{{--                     class="cursor-pointer">{{ $folder->title }}</div>--}}
{{--            @endforeach--}}
        </div>
        {{-- Back Button --}}
        <div>
{{--            @if ($course)--}}
{{--                <a wire:click="goBackCourse()"--}}
{{--                   class="">--}}
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
{{--                              d="m15 19-7-7 7-7" />--}}
{{--                    </svg>--}}
{{--                </a>--}}
{{--            @endif--}}
        </div>
    </div>

    <div role="tablist"
         class="mt-6 tabs ">
        <a role="tab"
           wire:click="setActiveStage('all')"
           class="tab  {{ $activedStage == 'all'
                ? '  font-semibold text-primary border-b-2 border-primary dark:border-primary dark:text-primary'
                : '' }}">الكل</a>
        @foreach ($stages as $stage)
            <a role="tab"
               wire:click='setActiveStage({{ $stage }})'
               class="tab  {{ $activedStage != 'all' && $activedStage['id'] == $stage->id
                    ? '  font-semibold text-primary border-b-2 border-primary dark:border-primary dark:text-primary'
                    : '' }}">{{ $stage->name }}</a>
        @endforeach
    </div>

    <div class="mt-10">
        @foreach ($categories as $key => $category)
            @if ($category[0]->courses->count() > 0)
                <div
                        class="flex items-center gap-2 text-2xl font-semibold cursor-pointer">
                    <div class="px-2 py-1 rounded bg-base-300 dark:bg-neutral">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    {{ $category[0]->name . ' | ' . $key }}
                </div>
                <div class="flex flex-col gap-6 mt-12">
                    @foreach ($category[0]->courses as $key => $course)
                        <livewire:clinet.components.main-course-row :$course
                                                                    :key="$course->id" />
                </div>
                @endforeach
    </div>
    @endif
    @endforeach

    <div class="sticky left-0 z-20 flex flex-col items-end justify-center gap-4 bottom-10"
         x-data="{ show_dropdown: false }">
        <div x-show="show_dropdown"
             class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-28 dark:bg-dark bottom-14">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownDefault">
                <li>
                    <button href="{{route('admin.course.create', 0)}}"
                            wire:navigate
                            x-on:click="show_dropdown=false"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">اضف
                        كورس</button>
                </li>
            </ul>
        </div>
        <div class="">
            <button type="button"
                    x-on:click="show_dropdown = !show_dropdown"
                    class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4 focus:outline-none  font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-secondary
            hover:scale-105 transition-all duration-300 shadow-md
            shadow-primary dark:shadow-white/50 ">
                <svg class="w-6 h-6 "
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     fill="none"
                     viewBox="0 0 24 24">
                    <path stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="
            M5
            12h14m-7
            7V5" />
                </svg>
                <span class="sr-only">add course</span>
            </button>

        </div>
    </div>

</div>
</div>
