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
            rel="stylesheet"/>

    <!-- Scripts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&family=Lato&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body x-data="{ show_search_modal: false, showCartCount:{{auth()->user() && count(auth()->user()->cart)> 0}} }"
      x-on:addToCart.window="console.log('ddd')"
{{--      x-on:addToCart.window="showCartCount={{auth()->user() && count(auth()->user()->cart)> 0}}"--}}
      class="font-sans antialiased
    {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }} bg-base-100   ">
<div class="min-h-screen ">

    {{--
    <livewire:components.navbar :$logo
        :$title /> --}}


    <nav class="fixed top-0 z-20 w-full start-0 md:pl-40 bg-base-100">
        <div
                class="flex flex-wrap items-center justify-between p-4 mx-auto max-w-screen-2xl">
            <div class="flex items-center justify-start flex-1">


                <div
                        class="flex items-center justify-start h-16 gap-1 p-1 text-white border rounded-full border-dark dark:border-white/25 min-h-10 lg:max-w-1/2">
                    <div
                            class="flex items-center justify-center h-full px-6 py-2 text-center transition-all duration-300 cursor-pointer min-w-28 rounded-s-full bg-primary dark:bg-neutral hover:bg-primary/70 dark:hover:bg-white/25 hover:scale-105">
                        @if (auth()->user())
                            <img src="{{ asset(auth()->user()->avatar) }}"
                                 class="w-10 h-10 rounded-full me-2"/>
                            {{ auth()->user()->first_name }}
                        @else
                            <a href="{{ route('login') }}"
                               wire:navigate>
                                تسجيل دخول
                            </a>
                        @endif
                    </div>
                    <div
                            class="flex items-center justify-center h-full gap-2 px-6 py-2 rounded-e-full bg-primary dark:bg-neutral">

                        <button
                                class="transition-all duration-100 ease-in-out hover:scale-125"
                                type="button"
                                x-on:click="$store.darkMode.toggle()">
                            <svg x-data
                                 x-show="$store.darkMode.on"
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="lucide lucide-sun">
                                <circle cx="12"
                                        cy="12"
                                        r="4"/>
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
                                 x-show="!$store.darkMode.on"
                                 xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="lucide lucide-moon">
                                <path
                                        d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                            </svg>
                        </button>

                        <button x-on:click="show_search_modal = true">
                            <svg class="w-6 h-6 text-gray-800 transition-all duration-100 ease-in-out cursor-pointer dark:text-white hover:scale-125"
                                 viewBox="0 0 25 25"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M18.2622 18.0481C18.6415 17.6714 19.2494 17.6714 19.6287 18.0481L22.1354 20.0715H22.179C22.6861 20.5841 22.6861 21.4152 22.179 21.9278C21.6718 22.4404 20.8496 22.4404 20.3424 21.9278L18.2622 19.5436L18.1832 19.4546C18.0362 19.2684 17.955 19.0364 17.955 18.7959C17.955 18.5152 18.0655 18.2462 18.2622 18.0481ZM11.3513 2.6875C13.5835 2.6875 15.7243 3.5838 17.3028 5.17922C18.8812 6.77464 19.768 8.93849 19.768 11.1948C19.768 15.8932 15.9997 19.702 11.3513 19.702C6.70285 19.702 2.93457 15.8932 2.93457 11.1948C2.93457 6.49633 6.70285 2.6875 11.3513 2.6875Z"
                                        fill="white"/>
                            </svg>
                        </button>
                        <div class="relative hover:scale-125 transition-all
                        duration-100 ease-in-out "
                             href="{{auth()->user() ?route('user.cart',auth()->user()->id) : '#'}}"
                             wire:navigate
                        >
                            <button
                            >
                                <svg class="w-6 h-6 text-gray-800 out cursor-pointer dark:text-white "
                                     viewBox="0 0 30 31"
                                     fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          clip-rule="evenodd"
                                          d="M24.0523 7.26952H7.20752L5.76826 4.68973C5.60672 4.40016 5.3011 4.2207 4.96952 4.2207H3.14023C2.63509 4.2207 2.22559 4.6302 2.22559 5.13535C2.22559 5.64049 2.63509 6.04999 3.14023 6.04999H4.43244L5.85281 8.59593L9.12854 15.8438L9.1319 15.8512L9.42042 16.4896L6.13156 19.9978C5.89508 20.25 5.82106 20.614 5.94024 20.9386C6.05943 21.2632 6.35145 21.4928 6.69497 21.532L9.69273 21.8746C13.4424 22.3032 17.2286 22.3032 20.9783 21.8746L23.976 21.532C24.4779 21.4747 24.8383 21.0213 24.7809 20.5195C24.7235 20.0176 24.2702 19.6572 23.7683 19.7146L20.7706 20.0572C17.1589 20.4699 13.5121 20.4699 9.90044 20.0572L8.71077 19.9212L11.1247 17.3464C11.148 17.3215 11.1697 17.2956 11.1897 17.2689L12.1078 17.3884C13.3943 17.5558 14.6948 17.5886 15.9881 17.4863C19.0045 17.2477 21.8002 15.8124 23.752 13.5002L24.457 12.665C24.4806 12.637 24.5026 12.6075 24.5227 12.5768L25.8366 10.5745C26.7679 9.1553 25.7498 7.26952 24.0523 7.26952ZM11.2577 15.4331C11.056 15.4068 10.8821 15.2787 10.7971 15.094L10.7955 15.0905L8.08752 9.0988H24.0523C24.2948 9.0988 24.4403 9.3682 24.3072 9.57095L23.0236 11.5272L22.3541 12.3202C20.7175 14.2591 18.3732 15.4627 15.8438 15.6627C14.6773 15.755 13.5043 15.7254 12.3438 15.5744L11.2577 15.4331Z"
                                          fill="white"/>
                                    <path
                                            d="M8.62809 23.4282C7.61781 23.4282 6.79881 24.2472 6.79881 25.2575C6.79881 26.2678 7.61781 27.0868 8.62809 27.0868C9.63838 27.0868 10.4574 26.2678 10.4574 25.2575C10.4574 24.2472 9.63838 23.4282 8.62809 23.4282Z"
                                            fill="white"/>
                                    <path
                                            d="M20.2136 25.2575C20.2136 24.2472 21.0326 23.4282 22.0429 23.4282C23.0532 23.4282 23.8722 24.2472 23.8722 25.2575C23.8722 26.2678 23.0532 27.0868 22.0429 27.0868C21.0326 27.0868 20.2136 26.2678 20.2136 25.2575Z"
                                            fill="white"/>
                                </svg>
                            </button>

                                <div
                                        x-data
                                        x-show="showCartCount"
                                        x-cloak
                                        class="absolute w-3 h-3 bg-warning
                                rounded-full top-0 right-0 text-primary
                                text-xs flex items-center
                                justify-center">{{auth()->user() ? count(auth()
                                ->user()->cart) : ''}}</div>
                        </div>

                        <svg class="w-6 h-6 text-gray-800 transition-all duration-100 ease-in-out cursor-pointer dark:text-white hover:scale-125"
                             viewBox="0 0 28 29"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M19.8514 3.05664H8.40751C5.24899 3.05664 2.68555 5.60864 2.68555 8.75572V15.5992V16.7436C2.68555 19.8907 5.24899 22.4427 8.40751 22.4427H10.1241C10.4331 22.4427 10.8451 22.6486 11.0396 22.9004L12.7562 25.1778C13.5115 26.1848 14.7474 26.1848 15.5027 25.1778L17.2193 22.9004C17.4368 22.6143 17.7801 22.4427 18.1349 22.4427H19.8514C23.01 22.4427 25.5734 19.8907 25.5734 16.7436V8.75572C25.5734 5.60864 23.01 3.05664 19.8514 3.05664ZM9.5519 14.5006C8.91104 14.5006 8.40751 13.9856 8.40751 13.3562C8.40751 12.7268 8.92249 12.2118 9.5519 12.2118C10.1813 12.2118 10.6963 12.7268 10.6963 13.3562C10.6963 13.9856 10.1928 14.5006 9.5519 14.5006ZM14.1295 14.5006C13.4886 14.5006 12.9851 13.9856 12.9851 13.3562C12.9851 12.7268 13.5001 12.2118 14.1295 12.2118C14.7589 12.2118 15.2739 12.7268 15.2739 13.3562C15.2739 13.9856 14.7703 14.5006 14.1295 14.5006ZM18.707 14.5006C18.0662 14.5006 17.5627 13.9856 17.5627 13.3562C17.5627 12.7268 18.0776 12.2118 18.707 12.2118C19.3365 12.2118 19.8514 12.7268 19.8514 13.3562C19.8514 13.9856 19.3479 14.5006 18.707 14.5006Z"
                                    fill="white"/>
                        </svg>

                        <svg class="w-6 h-6 text-gray-800 transition-all duration-100 ease-in-out cursor-pointer dark:text-white hover:scale-125"
                             viewBox="0 0 31 31"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M24.5043 18.6569L23.2372 16.5537C22.9712 16.0849 22.7304 15.198 22.7304 14.6785V11.473C22.7304 8.49555 20.982 5.92353 18.4606 4.71987C17.8018 3.55422 16.5855 2.83203 15.1918 2.83203C13.8107 2.83203 12.5691 3.57957 11.9102 4.75788C9.43955 5.98688 7.72909 8.53356 7.72909 11.473V14.6785C7.72909 15.198 7.48836 16.0849 7.22229 16.541L5.94261 18.6569C5.43581 19.5058 5.32178 20.4434 5.63853 21.305C5.94261 22.1539 6.66481 22.8127 7.60239 23.1295C10.0604 23.9657 12.6451 24.3711 15.2298 24.3711C17.8145 24.3711 20.3992 23.9657 22.8571 23.1421C23.7441 22.8507 24.4282 22.1792 24.7577 21.305C25.0871 20.4308 24.9984 19.4678 24.5043 18.6569Z"
                                    fill="white"/>
                            <path
                                    d="M18.7894 25.6494C18.2573 27.1191 16.8509 28.1707 15.2038 28.1707C14.2029 28.1707 13.2146 27.7653 12.5178 27.0431C12.1123 26.663 11.8082 26.1562 11.6309 25.6367C11.7956 25.6621 11.9603 25.6747 12.1377 25.7001C12.4291 25.7381 12.7332 25.7761 13.0372 25.8014C13.7594 25.8648 14.4943 25.9028 15.2292 25.9028C15.9514 25.9028 16.6735 25.8648 17.3831 25.8014C17.6491 25.7761 17.9152 25.7634 18.1686 25.7254C18.3713 25.7001 18.5741 25.6747 18.7894 25.6494Z"
                                    fill="white"/>
                        </svg>


                    </div>
                </div>
                <div class="flex space-x-3 md:order-2 md:space-x-0 ">

                    <button data-drawer-target="default-sidebar"
                            data-drawer-toggle="default-sidebar"
                            aria-controls="default-sidebar"
                            type="button"
                            class="inline-flex items-center p-2 mt-2 text-sm text-gray-500 rounded-lg ms-3 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6"
                             aria-hidden="true"
                             fill="currentColor"
                             viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
            <div
                    class="flex items-center justify-end w-full gap-2 text-lg font-bold text-primary dark:text-white md:w-fit md:justify-center">
                <h2>{{ $title ?? '' }}</h2>
                @if (isset($logo))
                        <?php echo $logo; ?>
                @endif
            </div>
        </div>
    </nav>


    <livewire:client.components.sidebar/>


    <!-- Content wrapper -->
    <main class="py-12 mt-20 sm:ml-40 lg:ms-4">
        <div
                class="py-4 mx-auto border-2 rounded-3xl max-w-screen-2xl sm:px-6 lg:px-8 border-base-300 dark:border-neutral min-h-[calc(100vh-200px)]">
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
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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
                                            fill="white"/>
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
                               placeholder="اكتب البحث"/>
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
<x-mary-toast />
</body>

</html>
