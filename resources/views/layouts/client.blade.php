@php
    use Illuminate\Support\Facades\Storage;

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    x-init="$store.darkMode.init()"
    x-data
    {{-- :class="$store.darkMode.on ? 'dark' : 'light'" --}}
    :data-theme="$store.darkMode.on ? 'dark' : 'light'">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Dr Hoopa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect"
        href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&family=Lato&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body x-data="{ show_search_modal: false }"
    class="font-sans antialiased
    {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }} bg-base-100   ">
    <div class="min-h-screen ">


        <livewire:components.navbar />


        <livewire:components.sidebar />


        <!-- Content wrapper -->
        <main class="py-12 mt-20 sm:ml-40 lg:ms-4">
            <div
                class="py-4 mx-auto border-2 rounded-2xl max-w-screen-2xl sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
        <!-- End Content wrapper -->
    </div>

    {{-- Search modal --}}
    <div id="search-modal"
        x-show="show_search_modal"
        x-transition
        tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 w-screen h-screen overflow-hidden md:inset-0">
        <div class="relative w-full h-full">
            <!-- Modal content -->
            <div class="relative w-full h-full rounded-lg shadow bg-dark">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 ">

                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        x-on:click="show_search_modal = false">
                        <svg class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div
                    class="flex items-center justify-center w-full h-full p-4 md:p-5 ">

                    <form class=" mx-auto w-[80%]">
                        <div class="relative w-full">
                            <span
                                class="absolute text-gray-500 start-0 bottom-3 dark:text-gray-400">
                                <svg class="w-4 h-4 text-gray-500 dark:text-white"
                                    viewBox="0 0
             25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.2622 18.0481C18.6415 17.6714 19.2494 17.6714 19.6287 18.0481L22.1354 20.0715H22.179C22.6861 20.5841 22.6861 21.4152 22.179 21.9278C21.6718 22.4404 20.8496 22.4404 20.3424 21.9278L18.2622 19.5436L18.1832 19.4546C18.0362 19.2684 17.955 19.0364 17.955 18.7959C17.955 18.5152 18.0655 18.2462 18.2622 18.0481ZM11.3513 2.6875C13.5835 2.6875 15.7243 3.5838 17.3028 5.17922C18.8812 6.77464 19.768 8.93849 19.768 11.1948C19.768 15.8932 15.9997 19.702 11.3513 19.702C6.70285 19.702 2.93457 15.8932 2.93457 11.1948C2.93457 6.49633 6.70285 2.6875 11.3513 2.6875Z"
                                        fill="white" />
                                </svg>
                            </span>
                            <input type="text"
                                id="search_input"
                                class="block
                        py-2.5
                        ps-6
                        pe-0 w-full text-sm text-gray-900 bg-transparent
                        border-0 border-b-2 border-gray-300 appearance-none
                        dark:text-white dark:border-gray-600
                        dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                placeholder="اكتب البحث" />
                            <label for="search_input"
                                class="absolute
                        text-sm text-gray-500 dark:text-gray-400 duration-300
                         transform -translate-y-6 scale-75 top-3 -z-10
                         origin-[0] peer-placeholder-shown:start-6
                         peer-focus:start-0 peer-focus:text-blue-600
                         peer-focus:dark:text-blue-500
                         peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">البحث</label>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
