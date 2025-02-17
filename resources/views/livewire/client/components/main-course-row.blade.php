<div class="relative w-full h-56 p-2 mb-56 bg-center bg-no-repeat bg-cover border-2 md:mb-28 rounded-3xl border-base-300 dark:border-neutral "
     style="background: url({{ Storage::url($course->thumbnail) }})"
     x-data="{ show_delete_confirm: false, selectedCourse:null }"
     href="{{ Route::is('admin.*') ? route('admin.course.view', $course->id) : route('client.course.view', $course->id) }}"
     wire:navigate class="text-white"
>
    <div
            class="absolute left-0 right-0 w-[calc(100%-40px)] mx-auto rounded-3xl min-h-40 bg-primary dark:bg-neutral p-2 py-4 md:p-4 text-white bottom-[-200px] md:bottom-[-100px]">
        {{-- First Row --}}
        <div class="flex items-center justify-between ">
            <div class="flex flex-col">
{{--                <a >--}}

                    <h3 class="text-3xl font-semibold">
                        {{ $course->title }}</h3>
{{--                </a>--}}
                <h5 class="text-sm font-light">
                    {{ $course->sub_title }}</h5>
            </div>
            @canany(['update', 'create'], $course)
                <x-mary-dropdown>
                    <x-slot:trigger>
                        <svg class="h-8 cursor-pointer"
                             viewBox="0 0 5 19"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M2.42596 2.14149C2.98177 2.14149 3.43235 2.59206 3.43235 3.14788C3.43235 3.70369 2.98177 4.15427 2.42596 4.15427C1.87014 4.15427 1.41956 3.70369 1.41956 3.14788C1.41956 2.59206 1.87014 2.14149 2.42596 2.14149ZM2.42596 8.46738C2.98177 8.46738 3.43235 8.91796 3.43235 9.47377C3.43235 10.0296 2.98177 10.4802 2.42596 10.4802C1.87014 10.4802 1.41956 10.0296 1.41956 9.47377C1.41956 8.91796 1.87014 8.46738 2.42596 8.46738ZM2.42596 14.7933C2.98177 14.7933 3.43235 15.2438 3.43235 15.7997C3.43235 16.3555 2.98177 16.8061 2.42596 16.8061C1.87014 16.8061 1.41956 16.3555 1.41956 15.7997C1.41956 15.2438 1.87014 14.7933 2.42596 14.7933Z"
                                    fill="white"
                                    stroke="white"
                                    stroke-width="1.15016"/>
                        </svg>
                    </x-slot:trigger>
                    @can('update', $course)
                        <x-mary-menu-item href="{{ route('admin.course.edit', ['id' => $course->id, 'edit' => true]) }}"
                                          wire:loading.class.delay="opacity-50"
                                          wire:navigate>
                            <div class="flex items-center
                                    justify-evenly text-info gap-2">
                                <svg class="w-4 h-4  md:w-6
                                        md:h-6"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path
                                            d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                    <path d="m15 5 4 4" />
                                </svg>
                                <p>تعديل</p>
                            </div>
                        </x-mary-menu-item>
                    @endcan
                    @can('delete', $course)
                        <x-mary-menu-item x-on:click="show_delete_confirm = true; selectedCourse = {{ $course->id }}">
                            <div class="flex items-center
                                    justify-evenly text-danger gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="w-4 h-4  md:w-6 md:h-6">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10"
                                          x2="10"
                                          y1="11"
                                          y2="17" />
                                    <line x1="14"
                                          x2="14"
                                          y1="11"
                                          y2="17" />
                                </svg>
                                <p>حذف</p>
                            </div>
                        </x-mary-menu-item>
                    @endcan
                </x-mary-dropdown>

            @endcanany

        </div>
        {{-- Second Row --}}
        <div class="grid grid-cols-2 gap-8 mt-4 md:grid-cols-4">
            <div class="flex items-center justify-start gap-2">
                <svg class="w-8"
                     viewBox="0 0 19 14"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M14.5243 13.4693H1.88043C1.43331 13.4693 1.00451 13.2972 0.688353 12.9909C0.372195 12.6847 0.19458 12.2693 0.19458 11.8362V2.03742C0.19458 1.13104 0.944781 0.404297 1.88043 0.404297H6.93796L8.62381 2.03742H14.5243C14.9714 2.03742 15.4002 2.20948 15.7163 2.51575C16.0325 2.82202 16.2101 3.23741 16.2101 3.67054H1.88043V11.8362L3.68428 5.30367H18.073L16.1511 12.2444C15.9572 12.9548 15.2998 13.4693 14.5243 13.4693Z"
                            fill="white"/>
                </svg>

                <p>({{ $course->children_count }})
                    كورسات
                </p>
            </div>
            <div class="flex items-center justify-start gap-2">
                <svg class="w-8"
                     viewBox="0 0 16 16"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M7.83446 0.575195C3.77048 0.575195 0.472168 3.8735 0.472168 7.93749C0.472168 12.0015 3.77048 15.2998 7.83446 15.2998C11.8984 15.2998 15.1968 12.0015 15.1968 7.93749C15.1968 3.8735 11.8984 0.575195 7.83446 0.575195ZM6.362 11.2505V4.62446L10.7794 7.93749L6.362 11.2505Z"
                            fill="white"/>
                </svg>

                <p>({{ $course->video_lessons_count }})
                    محاضرات </p>
            </div>
            <div class="flex items-center justify-start gap-2">
                <svg class="w-8"
                     viewBox="0 0 14 16"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M8.65763 3.57528V4.90296M8.65763 4.90296V6.23064M8.65763 4.90296H7.38776M8.65763 4.90296H9.92751M12.5386 6.18323V4.28844C12.5386 3.10935 12.5386 2.5198 12.2924 2.06945C12.0759 1.67331 11.7304 1.35123 11.3055 1.14939C10.8224 0.919922 10.19 0.919922 8.92524 0.919922H4.10747C2.84268 0.919922 2.21029 0.919922 1.72721 1.14939C1.30228 1.35123 0.956797 1.67331 0.740284 2.06945C0.494141 2.5198 0.494141 3.10935 0.494141 4.28844V11.5869C0.494141 12.766 0.494141 13.3555 0.740284 13.8059C0.956797 14.202 1.30228 14.5241 1.72721 14.7259C2.21029 14.9554 2.84268 14.9554 4.10747 14.9554H8.0219M8.0219 9.07567H2.48966M4.75833 12.1104H2.57727M9.90384 10.0446C10.0365 9.69305 10.2983 9.39665 10.6429 9.20786C10.9875 9.01906 11.3926 8.95004 11.7866 9.01304C12.1805 9.07603 12.5378 9.26697 12.7952 9.55203C13.0526 9.83709 13.1935 10.1979 13.1929 10.5705C13.1929 11.6224 11.3055 13.0587 11.3055 13.0587M10.8346 14.2536H11.016M6.29929 10.593H2.57727M3.31271 6.98932H2.81022L4.26357 2.85109H4.75833L6.21168 6.98932H5.70919L4.52641 3.50577H4.49549L3.31271 6.98932ZM3.49824 5.37282H5.52366V5.81736H3.49824V5.37282Z"
                            stroke="white"
                            stroke-width="0.667174"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                </svg>


                <p>({{ $course->quiz_lessons_count }})
                    كويزات </p>
            </div>
            <div class="flex items-center justify-start gap-2">
                <svg class="w-8"
                     viewBox="0 0 16 19"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d_3081_66459)">
                        <path
                                d="M10.6784 10.7032C10.6784 10.3857 10.4356 10.1284 10.1361 10.1284H5.79749C5.49797 10.1284 5.25517 10.3857 5.25517 10.7032C5.25517 11.0206 5.49797 11.2779 5.79749 11.2779H10.1361C10.4356 11.2779 10.6784 11.0206 10.6784 10.7032Z"
                                fill="white"/>
                        <path
                                d="M10.6784 13.7686C10.6784 13.4512 10.4356 13.1938 10.1361 13.1938H5.79749C5.49797 13.1938 5.25517 13.4512 5.25517 13.7686C5.25517 14.086 5.49797 14.3434 5.79749 14.3434H10.1361C10.4356 14.3434 10.6784 14.086 10.6784 13.7686Z"
                                fill="white"/>
                        <path fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M4.3513 2.46484C3.25308 2.46484 2.36279 3.40839 2.36279 4.57232V15.3013C2.36279 16.4652 3.25308 17.4088 4.3513 17.4088H11.5822C12.6805 17.4088 13.5708 16.4652 13.5708 15.3013V6.84661C13.5708 6.5548 13.481 6.27096 13.315 6.03813L11.1473 2.99749C10.9081 2.66203 10.5344 2.46484 10.1377 2.46484H4.3513ZM3.44743 4.57232C3.44743 4.04326 3.85211 3.61438 4.3513 3.61438H9.59374V6.98408C9.59374 7.30152 9.83654 7.55885 10.1361 7.55885H12.4861V15.3013C12.4861 15.8304 12.0814 16.2593 11.5822 16.2593H4.3513C3.85211 16.2593 3.44743 15.8304 3.44743 15.3013V4.57232Z"
                              fill="white"/>
                        <path
                                d="M3.96393 4.59969H4.7612C4.9986 4.59969 5.17402 4.66191 5.28746 4.78634C5.40091 4.90851 5.45763 5.09855 5.45763 5.35645C5.45763 5.89037 5.22549 6.15733 4.7612 6.15733H4.20658V6.94803H3.96393V4.59969ZM4.75805 5.92657C5.05847 5.92657 5.20868 5.73653 5.20868 5.35645C5.20868 5.1732 5.17297 5.03972 5.10154 4.95602C5.03011 4.87231 4.91561 4.83045 4.75805 4.83045H4.20658V5.92657H4.75805Z"
                                fill="white"/>
                        <path
                                d="M6.61028 4.59969C6.83087 4.59969 6.99998 4.65173 7.11763 4.7558C7.23738 4.85987 7.31721 4.99221 7.35713 5.15284C7.39704 5.31347 7.417 5.50125 7.417 5.71617C7.417 6.14602 7.35082 6.45936 7.21847 6.65618C7.08822 6.85075 6.88549 6.94803 6.61028 6.94803H5.83192V4.59969H6.61028ZM6.61028 6.71727C6.98213 6.71727 7.16805 6.39149 7.16805 5.73993C7.16805 5.42319 7.12288 5.19243 7.03255 5.04764C6.94221 4.90285 6.80145 4.83045 6.61028 4.83045H6.07456V6.71727H6.61028Z"
                                fill="white"/>
                        <path
                                d="M8.10565 4.83045V5.74671H9.00376V5.97747H8.10565V6.94803H7.863V4.59969H9.16763V4.83045H8.10565Z"
                                fill="white"/>
                    </g>
                    <defs>
                        <filter id="filter0_d_3081_66459"
                                x="0.761656"
                                y="0.863707"
                                width="14.4103"
                                height="18.1466"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0"
                                     result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha"
                                           type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                           result="hardAlpha"/>
                            <feOffset/>
                            <feGaussianBlur stdDeviation="0.800569"/>
                            <feComposite in2="hardAlpha"
                                         operator="out"/>
                            <feColorMatrix type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                            <feBlend mode="normal"
                                     in2="BackgroundImageFix"
                                     result="effect1_dropShadow_3081_66459"/>
                            <feBlend mode="normal"
                                     in="SourceGraphic"
                                     in2="effect1_dropShadow_3081_66459"
                                     result="shape"/>
                        </filter>
                    </defs>
                </svg>


                <p>({{ $course->item_lessons_count }})
                    اخرى
                </p>
            </div>

        </div>
        {{-- Third Row --}}
        <div
                class="grid grid-cols-1 gap-2 mt-4 !text-xs md:grid-cols-3 min-h-16">
            <div class="h-full rounded-s-full bg-white/5 dark:bg-white/5">
            </div>
            <div class="h-full bg-white/5 dark:bg-white/5">
            </div>
            <div
                    class="flex items-center justify-between h-full gap-2 p-2 md:rounded-e-full bg-white/5 dark:bg-white/5">
                @if(!auth()->check() || (auth()?->user()?->role_id == 2 &&
                !auth()?->user()?->hasCourse($course->id)))
                    {{--  --}}
                    <div>

                        <div class="flex items-center justify-start gap-2 ">
                            <svg class="w-6 h-6 dark:text-white text-dark"
                                 viewBox="0 0 15 15"
                                 fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10.5562 13.6263H4.58711C2.53376 13.6263 1.15491 12.2474 1.15491 10.1941V7.20954C1.15491 5.37108 2.28903 4.03999 4.04989 3.81913C4.21703 3.79526 4.40207 3.77734 4.58711 3.77734H10.5562C10.6994 3.77734 10.8844 3.78331 11.0755 3.81316C12.8363 4.0161 13.9884 5.35317 13.9884 7.20954V10.1941C13.9884 12.2474 12.6095 13.6263 10.5562 13.6263ZM4.58711 4.6727C4.44385 4.6727 4.30656 4.68463 4.16927 4.70254C2.85608 4.86967 2.05026 5.82473 2.05026 7.20954V10.1941C2.05026 11.7341 3.04709 12.7309 4.58711 12.7309H10.5562C12.0962 12.7309 13.093 11.7341 13.093 10.1941V7.20954C13.093 5.81279 12.2752 4.85178 10.9501 4.69658C10.8069 4.67271 10.6815 4.6727 10.5562 4.6727H4.58711Z"
                                        fill="currentColor"/>
                                <path
                                        d="M4.10356 4.70815C3.96031 4.70815 3.82899 4.64249 3.73945 4.52311C3.63798 4.38582 3.62604 4.20675 3.70364 4.05753C3.80511 3.85458 3.94837 3.6576 4.13341 3.47853L6.07335 1.53261C7.06421 0.547722 8.67585 0.547722 9.66671 1.53261L10.7113 2.58915C11.153 3.02489 11.4216 3.60985 11.4515 4.23063C11.4574 4.36792 11.4037 4.49923 11.3022 4.58876C11.2008 4.6783 11.0635 4.72009 10.9321 4.69622C10.8128 4.67831 10.6874 4.67234 10.5561 4.67234H4.58705C4.4438 4.67234 4.30651 4.68427 4.16922 4.70217C4.15131 4.70814 4.12744 4.70815 4.10356 4.70815ZM5.10039 3.77698H10.4487C10.3711 3.57403 10.2457 3.389 10.0786 3.22186L9.02802 2.15937C8.38933 1.52666 7.34475 1.52666 6.7001 2.15937L5.10039 3.77698Z"
                                        fill="currentColor"/>
                                <path
                                        d="M13.5406 10.3425H11.7499C10.8426 10.3425 10.1084 9.60835 10.1084 8.70106C10.1084 7.79376 10.8426 7.05957 11.7499 7.05957H13.5406C13.7853 7.05957 13.9883 7.26252 13.9883 7.50725C13.9883 7.75198 13.7853 7.95493 13.5406 7.95493H11.7499C11.338 7.95493 11.0038 8.28919 11.0038 8.70106C11.0038 9.11292 11.338 9.44719 11.7499 9.44719H13.5406C13.7853 9.44719 13.9883 9.65013 13.9883 9.89487C13.9883 10.1396 13.7853 10.3425 13.5406 10.3425Z"
                                        fill="currentColor"/>
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
                                            fill="currentColor"/>
                                    <path
                                            d="M6.98517 3.53345C7.01869 3.5722 7.08785 3.55473 7.09379 3.50602L7.255 2.18414C7.25866 2.15417 7.23441 2.12723 7.2009 2.12406L5.77986 1.98958C5.72656 1.98454 5.69253 2.03917 5.72534 2.0771L6.98517 3.53345Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M3.17627 4.0678C3.12569 4.0678 3.09719 4.01577 3.12816 3.97998L4.81684 2.02788C4.84121 1.99971 4.88872 1.99971 4.91308 2.02788L6.60173 3.97998C6.6327 4.01577 6.60419 4.0678 6.55361 4.0678H3.17627Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M3.64594 7.56346C3.67341 7.62076 3.58922 7.66773 3.54385 7.62043L0.744298 4.7025C0.710407 4.66718 0.738447 4.61254 0.790467 4.61254H2.19109C2.21542 4.61254 2.23742 4.62552 2.24701 4.64554L3.64594 7.56346Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M7.53883 4.61254C7.5145 4.61254 7.4925 4.62552 7.48291 4.64553L6.08394 7.56352C6.05648 7.62081 6.14066 7.66778 6.18604 7.62048L8.98564 4.7025C9.01953 4.66718 8.99149 4.61254 8.93947 4.61254H7.53883Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M7.64486 4.00745C7.64093 4.03968 7.66913 4.06783 7.70535 4.06783L8.83308 4.06783C8.88314 4.06783 8.91179 4.01675 8.88189 3.98082L7.89829 2.79899C7.86526 2.7593 7.79499 2.77642 7.78899 2.82562L7.64486 4.00745Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M1.94096 2.82568C1.93496 2.77648 1.86469 2.75935 1.83166 2.79904L0.848101 3.98082C0.818196 4.01675 0.846847 4.06783 0.896905 4.06783H2.02455C2.06077 4.06783 2.08898 4.03968 2.08505 4.00745L1.94096 2.82568Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M2.92986 4.68849C2.91263 4.65255 2.94209 4.61254 2.98579 4.61254H6.74411C6.78781 4.61254 6.81727 4.65255 6.80004 4.68849L4.92089 8.60814C4.8998 8.65213 4.83013 8.65213 4.80904 8.60814L2.92986 4.68849Z"
                                            fill="currentColor"/>
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
                    <button
                            class="rounded-full btn btn-info !text-xs px-2
                            md:px-4 hover:bg-info-600 transition-colors
                            duration-200 flex items-center gap-2 text-white"
                            {{--                        wire:click="addToCart"--}}
                            wire:loading.attr="disabled"
                            wire:target="addToCart"
                            @click="$wire.addToCart().then(() => window.location.reload())"
                    >
                        <span>شراء | اضافه الي السله</span>
                        <svg class="w-5 md:w-6"
                             viewBox="0 0 16 16"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M12.7925 3.7865H4.16306L3.42573 2.46489C3.34297 2.31654 3.18641 2.22461 3.01654 2.22461H2.07941C1.82062 2.22461 1.61084 2.43439 1.61084 2.69318C1.61084 2.95196 1.82062 3.16174 2.07941 3.16174H2.7414L3.46905 4.46601L5.14718 8.17908L5.14891 8.18287L5.29671 8.50991L3.61185 10.3071C3.4907 10.4363 3.45278 10.6228 3.51384 10.7891C3.57489 10.9554 3.7245 11.073 3.90048 11.0931L5.43621 11.2686C7.35713 11.4882 9.29681 11.4882 11.2177 11.2686L12.7535 11.0931C13.0106 11.0637 13.1952 10.8315 13.1658 10.5744C13.1364 10.3173 12.9042 10.1327 12.6471 10.162L11.1113 10.3375C9.26111 10.549 7.39283 10.549 5.54262 10.3375L4.93316 10.2679L6.16979 8.94883C6.18175 8.93607 6.19286 8.92282 6.20312 8.90914L6.67344 8.97034C7.33251 9.05609 7.99873 9.07291 8.66128 9.02051C10.2066 8.89829 11.6388 8.16296 12.6387 6.97842L12.9998 6.55057C13.012 6.53621 13.0232 6.52112 13.0335 6.5054L13.7066 5.47964C14.1837 4.75257 13.6622 3.7865 12.7925 3.7865Z"
                                    fill="currentColor"/>
                            <path
                                    d="M4.89081 12.0645C4.37324 12.0645 3.95367 12.4841 3.95367 13.0016C3.95367 13.5192 4.37324 13.9388 4.89081 13.9388C5.40837 13.9388 5.82794 13.5192 5.82794 13.0016C5.82794 12.4841 5.40837 12.0645 4.89081 12.0645Z"
                                    fill="currentColor"/>
                            <path
                                    d="M10.826 13.0016C10.826 12.4841 11.2456 12.0645 11.7631 12.0645C12.2807 12.0645 12.7002 12.4841 12.7002 13.0016C12.7002 13.5192 12.2807 13.9388 11.7631 13.9388C11.2456 13.9388 10.826 13.5192 10.826 13.0016Z"
                                    fill="currentColor"/>
                        </svg>
                    </button>
                @endif
            </div>


        </div>
    </div>

    {{-- delete course confirm --}}
    <div x-show="show_delete_confirm"
         id="delete-course-confirm"
         tabindex="-1"
         data-modal-backdrop="static"
         class="flex items-center justify-center overflow-y-auto overflow-x-hidden bg-dark/50
     fixed top-0 right-0 left-0 z-50
     w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button x-on:click="show_delete_confirm = false"
                        type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
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
                <div class="p-4 text-center md:p-5">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200"
                         aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3
                            class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        هل انت متأكد تريد حذف هذا الكورس </h3>
                    <button wire:click="deleteCourse(selectedCourse)"
                            x-on:click="show_delete_confirm = false"
                            type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        نعم، انا متأكد
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
