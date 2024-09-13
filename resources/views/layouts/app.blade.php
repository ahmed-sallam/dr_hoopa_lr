@php
    use Illuminate\Support\Facades\Storage;

@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      x-data :class="$store.darkMode.on ? 'dark' : 'light'"
>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Dr Hoopa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"/>

    <!-- Scripts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&family=Lato&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="font-sans antialiased {{ app()->getLocale() == 'ar' ? 'rtl' :
    'ltr' }} bg-white dark:bg-black text-black dark:text-white ">
<div class="min-h-screen ">


    <nav
        class="bg-white dark:bg-black fixed w-full z-20 top-0 start-0   md:pl-32">
        <div
            class="max-w-screen-2xl flex  items-center justify-between mx-auto p-4 flex-wrap">
            <div class="flex-1 flex items-center justify-start">

                <div class="flex md:order-2 space-x-3 md:space-x-0 ">

                    <button data-drawer-target="default-sidebar"
                            data-drawer-toggle="default-sidebar"
                            aria-controls="default-sidebar" type="button"
                            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true"
                             fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div
                    class=" border border-gray-50 dark:border-gray-800 rounded-full min-h-10 lg:max-w-1/2 flex items-center justify-start gap-1 p-1">
                    <div
                        class="min-w-28 py-2 px-6 rounded-s-full bg-gray-50 dark:bg-gray-800 text-center hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer hover:scale-105 transition-all duration-300 flex items-center justify-center">
                        <img src="{{ asset(auth()->user()->avatar) }}"
                             class="w-10 h-10 rounded-full me-2"/>
                        {{ auth()->user()->first_name }}
                    </div>
                    <div
                        class=" py-2 px-6 rounded-e-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center gap-2">

                        <button class="VPSwitch VPSwitchAppearance"
                                type="button"
                                @click="$store.darkMode.toggle()">
                            <svg x-data x-show="!$store.darkMode.on"
                                 xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-sun">
                                <circle cx="12" cy="12" r="4"/>
                                <path d="M12 2v2"/>
                                <path d="M12 20v2"/>
                                <path d="m4.93 4.93 1.41 1.41"/>
                                <path d="m17.66 17.66 1.41 1.41"/>
                                <path d="M2 12h2"/>
                                <path d="M20 12h2"/>
                                <path d="m6.34 17.66-1.41 1.41"/>
                                <path d="m19.07 4.93-1.41 1.41"/>
                            </svg>
                            <svg x-data
                                 x-show="$store.darkMode.on"
                                 xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-moon">
                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                            </svg>
                        </button>


                        <svg
                            class="w-10 h-10 text-gray-800 dark:text-white hover:scale-150 transition-all duration-300 cursor-pointer"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Z"/>
                            <path fill-rule="evenodd"
                                  d="M21.707 21.707a1 1 0 0 1-1.414 0l-3.5-3.5a1 1 0 0 1 1.414-1.414l3.5 3.5a1 1 0 0 1 0 1.414Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <svg
                            class="w-10 h-10 text-gray-800 dark:text-white hover:scale-150 transition-all duration-300 cursor-pointer"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                        <svg
                            class="w-10 h-10 text-gray-800 dark:text-white hover:scale-150 transition-all duration-300 cursor-pointer"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <svg
                            class="w-10 h-10 text-gray-800 dark:text-white hover:scale-150 transition-all duration-300 cursor-pointer"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"/>
                        </svg>

                    </div>
                </div>

            </div>
            <div class="flex items-center justify-center gap-2">
                <h2>{{ $title ?? '' }}</h2>
                @if (isset($logo))
                    <img src="{{ asset($logo) }}" class="w-10 h-10"
                         alt="{{ $title }}"/>
                @endif
            </div>
        </div>
    </nav>


    <aside id="default-sidebar"
           class="fixed top-0 left-0 z-40 w-32 h-screen transition-transform -translate-x-full sm:translate-x-0  lg:p-4"
           aria-label="Sidebar">
        <div
            class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 lg:rounded-3xl">
            <ul class="space-y-2 font-medium">
                <li class="flex items-center justify-center ">
                    <a href="#"
                       class="flex items-center justify-center flex-col p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
                        <img src="{{ asset('images/logo-light.png') }}"/>


                    </a>
                </li>
                <li class="flex items-center justify-center ">
                    <a href="{{ route('dashboard') }}" wire:navigate
                       class="flex items-center justify-center flex-col p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-28">

                        <img src="{{ asset('images/home.png') }}"
                             class="w-8 h-8"/>
                        <p>الرئيسية</p>
                    </a>
                </li>
                <li class="flex items-center justify-center ">
                    <a href="{{ route('user.index') }}" wire:navigate
                       class="w-28 flex items-center justify-center flex-col p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group
                            {{ request()->routeIs('user.index') ? 'bg-gray-700' : '' }}">

                        <img src="{{ asset('images/users.png') }}"
                             class="w-8 h-8"/>
                        <p>المستخدمين</p>
                    </a>
                </li>
                <li class="flex items-center justify-center ">
                    <a href="{{ route('course.index') }}" wire:navigate
                       class="w-28 flex items-center justify-center flex-col p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('course.index') ? 'bg-gray-700' : '' }}">

                        <img src="{{ asset('images/courses.png') }}"
                             class="w-8 h-8"/>
                        <p>الكورسات</p>
                    </a>
                </li>
            </ul>
        </div>
    </aside>


    <!-- Content wrapper -->
    <main class="py-12 sm:ml-28 mt-20">
        <div
            class=" border rounded-2xl border-gray-50 dark:border-gray-800 max-w-screen-2xl mx-auto sm:px-6 lg:px-8 py-4">
            {{ $slot }}
        </div>
    </main>
    <!-- End Content wrapper -->
</div>

</body>

</html>
