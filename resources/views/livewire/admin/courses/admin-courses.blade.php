<div class="relative  " style="height: 100% !important;">

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
                                stroke-width="1.14271"/>
                    </svg>
                    المزيد
                </div>
            </x-slot:trigger>
            <x-mary-menu-item title="الاقسام"
                              href="{{ route('admin.category.index') }}"
                              wire:navigate
                              class="text-primary"/>
            <x-mary-menu-item title="المراحل"
                              href="{{ route('admin.stage.index') }}"
                              wire:navigate
                              class="text-primary"/>
            <x-mary-menu-item title="اضف كورس"
                              href="{{route('admin.course.create', 0)}}"
                              wire:navigate
                              class="text-primary"/>
        </x-mary-dropdown>
        <div
                class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-dark">
            <a href="{{ route('admin.course.index') }}"
               wire:navigate
               class="cursor-pointer">الكورسات</a>

        </div>
        {{-- Back Button --}}

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

    <div class="" x-data="{ isCollapsed: {} }">
        @foreach ($categories as $key => $category)
            @foreach ($category as $key2 => $courses)
                @if ($courses->count() > 0)
                    <div
                            class="flex items-center gap-2 text-2xl font-semibold
                         cursor-pointer mt-10">
                        <div class="px-2 py-1 rounded bg-base-300 dark:bg-neutral"
                             x-on:click="isCollapsed[`${@js($key)}_${@js($key2)}`] = !isCollapsed[`${@js($key)}_${@js($key2)}`]">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="lucide lucide-chevron-down"
                                 :class="{ 'rotate-180': !isCollapsed[`${@js($key)}_${@js($key2)}`] }">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </div>
                        {{ $key . ' | ' . $key2 }}
                    </div>
                    <div class="flex flex-col gap-6 mt-12"
                         x-show="!isCollapsed[`${@js($key)}_${@js($key2)}`]"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="transform -translate-y-4 opacity-0"
                         x-transition:enter-end="transform translate-y-0 opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="transform translate-y-0 opacity-100"
                         x-transition:leave-end="transform -translate-y-4 opacity-0">
                        @foreach ($courses as $k => $course)
                            <livewire:client.components.main-course-row :$course
                                                                        :key="$course->id"/>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
