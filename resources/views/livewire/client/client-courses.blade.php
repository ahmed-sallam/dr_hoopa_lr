<div class="relative">
    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <div
            class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-neutral">
            <a href="{{ route('client.courses.index') }}"
                wire:navigate
                class="cursor-pointer">الكورسات</a>

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

</div>

</div>
