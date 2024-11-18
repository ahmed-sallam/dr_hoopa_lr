{{--hover:scale-105  transition-all duration-200 ease-in-out
hover:bg-gray-200  dark:hover:bg-white/10 --}}
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

            <div
                    class="grid grid-cols-4 w-full gap-1.5 text-xs font-light mt-2">
                {{-- price and add to cart section --}}
                {{-- <div
                class="flex items-end justify-between col-span-4 gap-2 p-1 border rounded-md border-b-gray-100 dark:border-gray-800 lg:col-span-3"> --}}
                <div
                        class="flex items-center justify-between h-full gap-2 p-1 md:p-2 !text-xs border-2 rounded-lg border-base-200 dark:border-white/10 w-full col-span-4 md:col-span-3">
                    {{--  --}}
                    <div>

                        <div class="flex items-center justify-start gap-2 ">
                            <svg class="w-6 h-6 dark:text-white text-dark"
                                 viewBox="0 0 15 15"
                                 fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10.5562 13.6263H4.58711C2.53376 13.6263 1.15491 12.2474 1.15491 10.1941V7.20954C1.15491 5.37108 2.28903 4.03999 4.04989 3.81913C4.21703 3.79526 4.40207 3.77734 4.58711 3.77734H10.5562C10.6994 3.77734 10.8844 3.78331 11.0755 3.81316C12.8363 4.0161 13.9884 5.35317 13.9884 7.20954V10.1941C13.9884 12.2474 12.6095 13.6263 10.5562 13.6263ZM4.58711 4.6727C4.44385 4.6727 4.30656 4.68463 4.16927 4.70254C2.85608 4.86967 2.05026 5.82473 2.05026 7.20954V10.1941C2.05026 11.7341 3.04709 12.7309 4.58711 12.7309H10.5562C12.0962 12.7309 13.093 11.7341 13.093 10.1941V7.20954C13.093 5.81279 12.2752 4.85178 10.9501 4.69658C10.8069 4.67271 10.6815 4.6727 10.5562 4.6727H4.58711Z"
                                        fill="currentColor" />
                                <path
                                        d="M4.10356 4.70815C3.96031 4.70815 3.82899 4.64249 3.73945 4.52311C3.63798 4.38582 3.62604 4.20675 3.70364 4.05753C3.80511 3.85458 3.94837 3.6576 4.13341 3.47853L6.07335 1.53261C7.06421 0.547722 8.67585 0.547722 9.66671 1.53261L10.7113 2.58915C11.153 3.02489 11.4216 3.60985 11.4515 4.23063C11.4574 4.36792 11.4037 4.49923 11.3022 4.58876C11.2008 4.6783 11.0635 4.72009 10.9321 4.69622C10.8128 4.67831 10.6874 4.67234 10.5561 4.67234H4.58705C4.4438 4.67234 4.30651 4.68427 4.16922 4.70217C4.15131 4.70814 4.12744 4.70815 4.10356 4.70815ZM5.10039 3.77698H10.4487C10.3711 3.57403 10.2457 3.389 10.0786 3.22186L9.02802 2.15937C8.38933 1.52666 7.34475 1.52666 6.7001 2.15937L5.10039 3.77698Z"
                                        fill="currentColor" />
                                <path
                                        d="M13.5406 10.3425H11.7499C10.8426 10.3425 10.1084 9.60835 10.1084 8.70106C10.1084 7.79376 10.8426 7.05957 11.7499 7.05957H13.5406C13.7853 7.05957 13.9883 7.26252 13.9883 7.50725C13.9883 7.75198 13.7853 7.95493 13.5406 7.95493H11.7499C11.338 7.95493 11.0038 8.28919 11.0038 8.70106C11.0038 9.11292 11.338 9.44719 11.7499 9.44719H13.5406C13.7853 9.44719 13.9883 9.65013 13.9883 9.89487C13.9883 10.1396 13.7853 10.3425 13.5406 10.3425Z"
                                        fill="currentColor" />
                            </svg>

                            @if ($course->discount && $course->discount > 0)
                                <p>{{ $course->net_price }}
                                    ج.م
                                </p>
                                <p class="line-through text-danger">
                                    {{ $course->price }}
                                    ج.م
                                </p>
                            @else
                                <p>{{ $course->price }} ج.م
                                </p>
                            @endif

                        </div>
                        @if ($course->discount && $course->discount > 0)
                            <div class="flex items-center justify-start gap-2 ">
                                <svg class="w-6 h-6"
                                     viewBox="0 0 10 10"
                                     fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.00458 2.07711C4.03739 2.03917 4.00336 1.98454 3.95006 1.98959L2.52904 2.12407C2.49553 2.12724 2.47128 2.15417 2.47494 2.18415L2.63613 3.50601C2.64207 3.55472 2.71123 3.57219 2.74474 3.53345L4.00458 2.07711Z"
                                            fill="currentColor" />
                                    <path
                                            d="M6.98517 3.53345C7.01869 3.5722 7.08785 3.55473 7.09379 3.50602L7.255 2.18414C7.25866 2.15417 7.23441 2.12723 7.2009 2.12406L5.77986 1.98958C5.72656 1.98454 5.69253 2.03917 5.72534 2.0771L6.98517 3.53345Z"
                                            fill="currentColor" />
                                    <path
                                            d="M3.17627 4.0678C3.12569 4.0678 3.09719 4.01577 3.12816 3.97998L4.81684 2.02788C4.84121 1.99971 4.88872 1.99971 4.91308 2.02788L6.60173 3.97998C6.6327 4.01577 6.60419 4.0678 6.55361 4.0678H3.17627Z"
                                            fill="currentColor" />
                                    <path
                                            d="M3.64594 7.56346C3.67341 7.62076 3.58922 7.66773 3.54385 7.62043L0.744298 4.7025C0.710407 4.66718 0.738447 4.61254 0.790467 4.61254H2.19109C2.21542 4.61254 2.23742 4.62552 2.24701 4.64554L3.64594 7.56346Z"
                                            fill="currentColor" />
                                    <path
                                            d="M7.53883 4.61254C7.5145 4.61254 7.4925 4.62552 7.48291 4.64553L6.08394 7.56352C6.05648 7.62081 6.14066 7.66778 6.18604 7.62048L8.98564 4.7025C9.01953 4.66718 8.99149 4.61254 8.93947 4.61254H7.53883Z"
                                            fill="currentColor" />
                                    <path
                                            d="M7.64486 4.00745C7.64093 4.03968 7.66913 4.06783 7.70535 4.06783L8.83308 4.06783C8.88314 4.06783 8.91179 4.01675 8.88189 3.98082L7.89829 2.79899C7.86526 2.7593 7.79499 2.77642 7.78899 2.82562L7.64486 4.00745Z"
                                            fill="currentColor" />
                                    <path
                                            d="M1.94096 2.82568C1.93496 2.77648 1.86469 2.75935 1.83166 2.79904L0.848101 3.98082C0.818196 4.01675 0.846847 4.06783 0.896905 4.06783H2.02455C2.06077 4.06783 2.08898 4.03968 2.08505 4.00745L1.94096 2.82568Z"
                                            fill="currentColor" />
                                    <path
                                            d="M2.92986 4.68849C2.91263 4.65255 2.94209 4.61254 2.98579 4.61254H6.74411C6.78781 4.61254 6.81727 4.65255 6.80004 4.68849L4.92089 8.60814C4.8998 8.65213 4.83013 8.65213 4.80904 8.60814L2.92986 4.68849Z"
                                            fill="currentColor" />
                                </svg>

                                <p>توفير
                                    {{ ($course->price * $course->discount) / 100 }}
                                    ج.م</p>
                                {{-- yello badg with  20% discount  --}}
                                <span
                                        class="flex items-center gap-1 px-1 py-1 text-xs text-black rounded-md bg-warning">
                                    خصم
                                    {{ $course->discount }}%
                                </span>
                            </div>
                        @endif

                    </div>

                    {{--  --}}
                    <button class=" btn btn-error !text-xs px-2 md:px-4"
                            wire:click="removeFromCart">
                        حذف من السلة
                    </button>
                </div>
                <div class="col-span-1 flex flex-col items-center justify-center">
                    تاريخ الاضافة
                    <strong>{{$item->created_at->format('Y-m-d')}}</strong>
                </div>

            </div>
        </div>
    </div>

</div>
