<aside id="default-sidebar"
       class="fixed top-0 left-0 z-40 w-40 h-screen transition-transform -translate-x-full sm:translate-x-0 lg:p-4"
       aria-label="Sidebar">
    <div
            class="w-full h-full px-3 py-4 overflow-y-auto bg-primary dark:bg-neutral lg:rounded-3xl">
        <ul class="w-full space-y-2 font-medium">
            <li class="flex items-center justify-center w-full mb-10">
                <a href="#"
                   class="flex flex-col items-center justify-center w-full p-2 rounded-lg group">
                    {{--
            <svg class="w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                viewBox="0 0 64 49" fill="none" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <path d="M64 0H0V49H64V0Z" fill="url(#pattern0_3707_5511)" fill-opacity="0.7" />
                <defs>
                    <pattern id="pattern0_3707_5511" patternContentUnits="objectBoundingBox"
                        width="1" height="1">
                        <use xlink:href="#image0_3707_5511"
                            transform="matrix(0.00118001 0 0 0.00154766 -0.625 -0.335737)" />
                    </pattern>

                </defs>
            </svg> --}}
                    <img src="{{ asset('images/logo-light.png') }}"
                         class="w-full h-auto"/>
                </a>
            </li>
            <li class="flex items-center justify-center ">
                <a href="{{ route('admin.dashboard') }}"
                   wire:navigate
                   class="w-full flex items-center justify-center flex-col
           p-2  rounded-lg font-semibold group hover:bg-white
                hover:dark:bg-white/15 hover:text-primary
                hover:dark:text-white
                {{ request()->routeIs('admin.dashboard')
                    ? ' bg-white  dark:bg-white/15 text-primary dark:text-white '
                    : ' text-white  dark:text-accent ' }}">
                    <svg class="w-8 h-8"
                         viewBox="0 0 30 29"
                         fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M25.6691 9.67812L17.7545 3.34645C16.2079 2.11395 13.7912 2.10187 12.2566 3.33437L4.34205 9.67812C3.20622 10.5844 2.51746 12.3969 2.75913 13.8227L4.28163 22.9335C4.63205 24.9756 6.52913 26.5827 8.59538 26.5827H21.4037C23.4458 26.5827 25.3791 24.9394 25.7295 22.9215L27.252 13.8106C27.4695 12.3969 26.7808 10.5844 25.6691 9.67812ZM15.9058 21.7494C15.9058 22.2448 15.495 22.6556 14.9995 22.6556C14.5041 22.6556 14.0933 22.2448 14.0933 21.7494V18.1244C14.0933 17.629 14.5041 17.2181 14.9995 17.2181C15.495 17.2181 15.9058 17.629 15.9058 18.1244V21.7494Z"
                                fill="currentColor"/>
                    </svg>

                    <p>الرئيسية</p>
                </a>
            </li>
            @if (auth()->user())
                <li class="flex items-center justify-center w-full">
                    <a href="{{ route('admin.user.index') }}"
                       wire:navigate
                       class="w-full flex items-center justify-center flex-col
           p-2  rounded-lg font-semibold group hover:bg-white
                hover:dark:bg-white/15 hover:text-primary
                hover:dark:text-white
                {{ request()->routeIs('admin.user.index')
                    ? ' bg-white  dark:bg-white/15 text-primary dark:text-white '
                    : ' text-white  dark:text-accent ' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             class="w-8 h-8 ">
                            <path d="M18 21a8 8 0 0 0-16 0"/>
                            <circle cx="10"
                                    cy="8"
                                    r="5"/>
                            <path
                                    d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/>
                        </svg>
                        <p>المستخدمين</p>
                    </a>
                </li>
            @endif
            <li class="flex items-center justify-center ">
                <a href="{{ route('admin.course.index') }}"
                   wire:navigate
                   class="w-full flex items-center justify-center flex-col
           p-2  rounded-lg font-semibold group hover:bg-white
                hover:dark:bg-white/15 hover:text-primary
                hover:dark:text-white
                {{ request()->routeIs('admin.course.index')
                    ? ' bg-white  dark:bg-white/15 text-primary dark:text-white '
                    : ' text-white  dark:text-accent ' }}">
                    <svg class="w-8 h-8 "
                         viewBox="0 0 30 30"
                         fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M21.0379 19.5502C21.8754 19.0002 22.9754
                 19.6002 22.9754 20.6002V22.2127C22.9754 23.8002
                 21.7379 25.5002 20.2504 26.0002L16.2629 27.3252C15.5629 27.5627 14.4254 27.5627 13.7379 27.3252L9.75039 26.0002C8.25039 25.5002 7.02539 23.8002 7.02539 22.2127V20.5877C7.02539 19.6002
                 8.12539 19.0002 8.95039 19.5377L11.5254 21.2127C12.5129
                 21.8752 13.7629 22.2002 15.0129 22.2002C16.2629 22.2002 17.5129 21.8752 18.5004 21.2127L21.0379 19.5502Z"
                                fill="currentColor"/>
                        <path
                                d="M24.9754 8.07422L17.4879 3.16172C16.1379
                 2.27422 13.9129 2.27422 12.5629 3.16172L5.03789
                 8.07422C2.62539 9.63672 2.62539 13.1742 5.03789
                 14.7492L7.03789 16.0492L12.5629 19.6492C13.9129
                 20.5367 16.1379 20.5367 17.4879 19.6492L22.9754
                 16.0492L24.6879 14.9242V18.7492C24.6879 19.2617
                 25.1129 19.6867 25.6254 19.6867C26.1379 19.6867 26.5629 19.2617 26.5629 18.7492V12.5992C27.0629 10.9867 26.5504 9.11172 24.9754 8.07422Z"
                                fill="currentColor"/>
                    </svg>

                    <p>الكورسات</p>
                </a>
            </li>
            <li class="flex items-center justify-center ">
                <a href="{{ route('admin.finance.index') }}"
                   wire:navigate
                   class="w-full flex items-center justify-center flex-col
           p-2  rounded-lg font-semibold group hover:bg-white
                hover:dark:bg-white/15 hover:text-primary
                hover:dark:text-white
                {{ request()->routeIs('admin.finance.*')
                    ? ' bg-white  dark:bg-white/15 text-primary dark:text-white '
                    : ' text-white  dark:text-accent ' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                         class="w-8 h-8 " viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         >
                        <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/>
                        <path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/>
                        <path d="m2 16 6 6"/>
                        <circle cx="16" cy="9" r="2.9"/>
                        <circle cx="6" cy="5" r="3"/>
                    </svg>
                    <p>المالية</p>
                </a>
            </li>
        </ul>
    </div>
</aside>
