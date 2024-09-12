<div
    class="flex hover:scale-105  transition-all duration-300  flex-col md:flex-row md:items-center  border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 w-full md:h-[200px] ">
    <div class="md:w-1/3 h-full">
        <img class="object-cover w-full h-full rounded-t-lg md:rounded-none md:rounded-s-lg "
            src="{{ Storage::url($course->thumbnail) }}" alt="Course Image">
    </div>
    <div class="flex flex-col justify-between items-start p-4 leading-normal md:w-2/3 h-full">
        <div>

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white cursor-pointer hover:text-primary hover:underline"
                wire:click="$parent.selectCourse({{ $course }})">
                {{ $course->title }}</h5>
            {{-- sub stitle --}}
            <h6 class="text-sm font-light ">{{ $course->sub_title }}</h6>
        </div>

        <div class="grid grid-cols-3 w-full gap-1.5 text-xs font-light">
            {{-- price and add to cart section --}}
            <div
                class=" border rounded-md border-b-gray-100 dark:border-gray-800 flex items-center justify-between gap-2 p-1 col-span-3 md:col-span-2">
                <div>
                    <div class="flex items-center justify-start gap-2 ">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        @if ($course->discount && $course->discount > 0)
                            <p>{{ $course->net_price }} ج.م</p>
                            <p class="line-through text-danger">{{ $course->price }} ج.م</p>
                        @else
                            <p>{{ $course->price }} ج.م</p>
                        @endif

                    </div>
                    @if ($course->discount && $course->discount > 0)
                        <div class="flex items-center justify-start gap-2 ">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4 2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                            </svg>
                            <p>توفير {{ ($course->price * $course->discount) / 100 }} ج.م</p>
                            {{-- yello badg with  20% discount  --}}
                            <span
                                class="bg-yellow-500 text-black text-xs px-2 py-1 rounded-md flex items-center gap-1.5">
                                خصم {{ $course->discount }}%
                            </span>
                        </div>
                    @endif

                </div>
                {{-- btton add to cart with icon --}}
                <button
                    class=" bg-primary/80 text-black text-xs px-4 py-1 rounded-md flex items-center gap-1.5 dark:bg-primary/70 dark:hover:bg-primary/80 ">
                    <svg class="w-6 h-6 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
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
