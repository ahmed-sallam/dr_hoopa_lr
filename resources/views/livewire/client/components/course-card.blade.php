<div
        class="
    border border-dark dark:border-white/25  rounded-lg
    shadow  w-full md:min-h-[200px] p-2 gap-2 h-fit">
    <div
            class="flex flex-col w-full gap-2 md:flex-row md:items-center md:h-40 md:max-h-full">
        <div class="h-full md:w-1/4">
            <img class="object-cover w-full h-full rounded-lg "
                 src="{{ Storage::url($course->thumbnail) }}"
                 alt="Course Image">
        </div>
        <div class="flex flex-col items-start justify-between h-full md:w-3/4 ">
            <div>
                <a href="{{ route('client.course.view', $course->id) }}"
                   wire:navigate>
                    <h5
                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 cursor-pointer dark:text-white hover:text-primary hover:underline">
                        {{ $course->title }}</h5>
                </a>
                {{-- sub stitle --}}
                <h6 class="text-sm font-light ">{{ $course->sub_title }}</h6>
                <p class="text-sm font-light ">د. عبدالوهاب - Doctor HOopa</p>
            </div>


        </div>
    </div>

</div>
