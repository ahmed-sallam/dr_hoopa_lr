<div
    class="flex hover:scale-105  transition-all duration-200 ease-in-out
flex-col md:flex-row md:items-center
border border-dark dark:border-white/25 hover:border-primary
dark:hover:border-primary rounded-lg bg-gray-100
shadow hover:bg-gray-200  dark:hover:bg-white/10 w-full md:h-[80px] p-4">

    {{-- Lesson title --}}
    <div class="flex items-center justify-between px-4 py-4">
        <div class="flex flex-row items-center h-full ">
            <div class="w-fit">
                <svg class="text-primary dark:text-dark"
                    width="43"
                    height="43"
                    viewBox="0 0 43 43"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.484375 21.3857C0.484375 9.75271 9.91482 0.322266 21.5479 0.322266H35.3473C39.5233 0.322266 42.9086 3.70755 42.9086 7.88351V21.2371C42.9086 32.9522 33.337 42.4492 21.6219 42.4492C9.98887 42.4492 0.484375 33.0188 0.484375 21.3857Z"
                        fill="#cccccc" />
                    <path
                        d="M21.6968 8.81445C14.7577 8.81445 9.12598 14.4462 9.12598 21.3853C9.12598 28.3244 14.7577 33.9561 21.6968 33.9561C28.6359 33.9561 34.2676 28.3244 34.2676 21.3853C34.2676 14.4462 28.6359 8.81445 21.6968 8.81445ZM19.1826 27.0422V15.7284L26.7251 21.3853L19.1826 27.0422Z"
                        fill="currentColor" />
                </svg>
            </div>

            <div class="flex flex-col p-4">
                <h5
                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 cursor-pointer dark:text-white hover:text-primary hover:underline">
                    {{ $lesson->title }}</h5>
                <h6 class="text-sm font-light ">{{ $lesson->sub_title }}</h6>
            </div>
        </div>
        <div>
        </div>
    </div>
</div>
