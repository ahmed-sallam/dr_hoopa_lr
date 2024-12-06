<div class="p-4 col-span-12 bg-transparent absolute  top-[-160px] md:top-[-180px] right-0 left-0 z-10"
     x-data="{ show_delete_confirm: false }">
    <div
            class="flex flex-col items-start justify-between w-full p-2 text-white shadow-lg min-h-40 md:min-h-48 bg-primary dark:bg-neutral rounded-3xl width md:p-3">
        {{-- first row title --}}
        <div
                class="flex flex-col items-start justify-between w-full gap-2 md:items-center md:flex-row ">
            {{-- title & icon --}}
            <div class="flex justify-start gap-2 itms-center">
                @if ($currentChildrenView == 'one_course')
                    <svg class="w-12 h-12 md:w-16 md:h-16"
                         viewBox="0 0 79 57"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M62.5411 57H7.37846C5.42779 57 3.55701 56.2493 2.17767
              54.9131C0.798339 53.5769 0.0234375 51.7647 0.0234375
              49.875V7.125C0.0234375 3.17062 3.29642 0 7.37846 0H29.4435L36.7985
              7.125H62.5411C64.4918 7.125 66.3626 7.87567 67.7419 9.21186C69.1212
              10.5481 69.8961 12.3603 69.8961 14.25H7.37846V49.875L15.2483 21.375H78.0234L69.6387
              51.6562C68.7929 54.7556 65.9244 57 62.5411 57Z"
                              fill="white"/>
                    </svg>
                @elseif($currentChildrenView == 'view_lesson')
                    @if ($content->content_type == 'video')
                        <svg class="w-12 h-12 text-primary dark:text-dark md:w-16 md:h-16"
                             viewBox="0 0 43 43"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.484375 21.3857C0.484375 9.75271 9.91482 0.322266 21.5479 0.322266H35.3473C39.5233 0.322266 42.9086 3.70755 42.9086 7.88351V21.2371C42.9086 32.9522 33.337 42.4492 21.6219 42.4492C9.98887 42.4492 0.484375 33.0188 0.484375 21.3857Z"
                                    fill="#cccccc"/>
                            <path
                                    d="M21.6968 8.81445C14.7577 8.81445 9.12598 14.4462 9.12598 21.3853C9.12598 28.3244 14.7577 33.9561 21.6968 33.9561C28.6359 33.9561 34.2676 28.3244 34.2676 21.3853C34.2676 14.4462 28.6359 8.81445 21.6968 8.81445ZM19.1826 27.0422V15.7284L26.7251 21.3853L19.1826 27.0422Z"
                                    fill="currentColor"/>
                        </svg>
                    @elseif ($content->content_type == 'quiz')
                        <svg class="w-12 h-12 text-primary dark:text-dark md:w-16 md:h-16"
                             width="42"
                             height="42"
                             viewBox="0 0 42 42"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.291016 20.8031C0.291016 9.61049 9.36438 0.537109 20.5569 0.537109H34.4298C38.611 0.537109 42.0005 3.92665 42.0005 8.10787V20.2142C42.0005 31.732 32.6635 41.069 21.1458 41.069H20.557C9.36439 41.069 0.291016 31.9956 0.291016 20.8031Z"
                                    fill="#CCCCCC"/>
                            <path fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M25.9233 9.59144C25.7385 9.40659 25.488 9.30273 25.2267 9.30273C24.9654 9.30273 24.7148 9.40659 24.5301 9.59144L12.4557 21.6729C12.3319 21.7967 12.2434 21.9513 12.1991 22.1208L10.8856 27.1524C10.7972 27.491 10.8949 27.8511 11.1422 28.0985C11.3895 28.346 11.7494 28.4437 12.0878 28.3552L17.1165 27.0409C17.2858 26.9967 17.4403 26.9081 17.5641 26.7842L29.6385 14.7028C30.0232 14.3179 30.0232 13.6937 29.6385 13.3088L25.9233 9.59144ZM14.0379 22.8778L25.2267 11.6825L27.5487 14.0058L16.3599 25.2011L13.217 26.0225L14.0379 22.8778Z"
                                  fill="#033468"/>
                            <path
                                    d="M11.2947 30.3313C10.7506 30.3313 10.3096 30.7726 10.3096 31.317C10.3096 31.8614 10.7506 32.3027 11.2947 32.3027H30.9975C31.5416 32.3027 31.9826 31.8614 31.9826 31.317C31.9826 30.7726 31.5416 30.3313 30.9975 30.3313H11.2947Z"
                                    fill="#033468"/>
                        </svg>
                    @endif
                @endif

                <div class="flex flex-col items-start justify-center gap-2">
                    <h2 class="text-base font-semibold md:text-3xl">
                        {{ $content->title }}</h2>
                    <p class="text-xs md:tex-sm">
                        {{ $content->sub_title }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">

                @if ($currentChildrenView == 'one_course')
                    @if(!auth()->check() || (auth()?->user()?->role_id == 2 &&
           !auth()?->user()?->hasCourse($content->id)))
                        <div
                                class="flex items-center justify-between h-full gap-2 p-1 md:p-2 !text-xs border-2 rounded border-white/10 dark:border-white/10">
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

                                    @if ($content->discount && $content->discount > 0)
                                        <p>{{ $content->net_price }}
                                            ج.م
                                        </p>
                                        <p class="line-through text-danger">
                                            {{ $content->price }}
                                            ج.م
                                        </p>
                                    @else
                                        <p>{{ $content->price }} ج.م
                                        </p>
                                    @endif

                                </div>
                                @if ($content->discount && $content->discount > 0)
                                    <div
                                            class="flex items-center justify-start gap-2 ">
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
                                            {{ ($content->price * $content->discount) / 100 }}
                                            ج.م</p>
                                        {{-- yello badg with  20% discount  --}}
                                        <span
                                                class="flex items-center gap-1 px-1 py-1 text-xs text-black rounded-md bg-warning">
                                        خصم
                                        {{ $content->discount }}%
                                    </span>
                                    </div>
                                @endif

                            </div>

                            {{--  --}}
                            <button class=" btn btn-info !text-xs px-2 md:px-4 text-white"
                                    @click="$wire.addToCart()">
                                شراء | اضافه الي السله
                                <svg class="w-6 md:w-8 "
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
                        </div>
                    @endif


                    @canany(['update', 'create'], $content)
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
                        @can('update', $content)
                                <x-mary-menu-item href="{{ route('admin.course.edit', ['id' => $content->id, 'edit' => true]) }}"
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
                                @can('delete', $content)
                                <x-mary-menu-item x-on:click="show_delete_confirm = true">
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
                                        <p>حذث</p>
                                    </div>
                                </x-mary-menu-item>
                                @endcan
                            </x-mary-dropdown>


                        @endcanany
                    {{-- <button
                        wire:click="$parent.selectChildrenView('edit_course')"
                        type="button"
                        class="p-1.5 md:p-3 rounded-full bg-white/90 dark:bg-white/90 hover:bg-white/10 cursor-pointer">
                        <svg class="w-4 h-4 text-secondary md:w-6 md:h-6"
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
                    </button>
                    <button x-on:click="show_delete_confirm = true"
                        type="button"
                        class="p-1.5 md:p-3 rounded-full bg-danger/80 hover:bg-white/10 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-4 h-4 text-white md:w-6 md:h-6">
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
                    </button> --}}
                @elseif($currentChildrenView == 'view_lesson')
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
                    {{-- <button
                        wire:click="$parent.selectChildrenView('edit_lesson')"
                        type="button"
                        class="p-1.5 md:p-3 rounded-full bg-white/90 dark:bg-white/90 hover:bg-white/10 cursor-pointer">
                        <svg class="w-4 h-4 text-secondary md:w-6 md:h-6"
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
                    </button> --}}
                @endif
            </div>

        </div>
        {{-- last row actions --}}
        <div
                class="grid w-full grid-cols-1 gap-2 mt-4 text-lg text-white md:grid-cols-4 min-h-16">
            <button
                    class="flex items-center justify-center w-full h-full col-span-1 gap-2 p-4 text-white border-0 bg-white/5 dark:bg-white/5 btn rounded-3xl hover:bg-white/10 dark:hover:bg-white/10">
                <svg width="26"
                     height="23"
                     viewBox="0 0 26 23"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M24.4858 12.2581C24.8072 11.9969 24.9678 11.8664 25.0267 11.711C25.0784 11.5746 25.0784 11.4254 25.0267 11.289C24.9678 11.1336 24.8072 11.0031 24.4858 10.7419L13.335 1.68003C12.7818 1.23048 12.5053 1.0057 12.2711 1.00019C12.0676 0.995406 11.8732 1.08018 11.7446 1.2298C11.5966 1.40195 11.5966 1.74734 11.5966 2.43812V7.79897C8.7865 8.26507 6.21464 9.61509 4.30339 11.6421C2.2197 13.852 1.06709 16.7119 1.06546 19.6762V20.44C2.4468 18.8623 4.17149 17.5863 6.12139 16.6994C7.84051 15.9175 9.69888 15.4543 11.5966 15.3323V20.5619C11.5966 21.2527 11.5966 21.598 11.7446 21.7702C11.8732 21.9198 12.0676 22.0046 12.2711 21.9998C12.5053 21.9943 12.7818 21.7695 13.335 21.32L24.4858 12.2581Z"
                            fill="white"
                            stroke="white"
                            stroke-width="0.73669"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                </svg>

                مشاركة
            </button>
            <button
                    class="flex items-center justify-center w-full h-full col-span-1 gap-2 p-4 text-white border-0 bg-white/5 dark:bg-white/5 btn rounded-3xl hover:bg-white/10 dark:hover:bg-white/10">

            </button>
            <button
                    class="flex items-center justify-center w-full h-full col-span-1 gap-2 p-4 text-white border-0 bg-white/5 dark:bg-white/5 btn rounded-3xl hover:bg-white/10 dark:hover:bg-white/10">

            </button>
            <button
                    class="flex items-center justify-center w-full h-full col-span-1 gap-2 p-4 text-white border-0 bg-white/5 dark:bg-white/5 btn rounded-3xl hover:bg-white/10 dark:hover:bg-white/10">

            </button>
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
                    <button wire:click="deleteCourse()"
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
