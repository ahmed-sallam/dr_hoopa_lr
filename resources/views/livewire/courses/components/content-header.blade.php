<div class="p-4 col-span-12 bg-transparent absolute  top-[-160px] md:top-[-180px] right-0 left-0"
    x-data>
    <div
        class="flex flex-col items-start justify-between w-full p-2 text-white shadow-lg h-44 md:h-56 bg-primary dark:bg-dark rounded-3xl width md:p-3">
        {{-- first row title --}}
        <div class="flex items-center justify-between w-full">
            {{-- title & icon --}}
            <div class="flex justify-start gap-2 itms-center">
                @if (
                    $currentChildrenView == 'one_course' ||
                        $currentChildrenView == 'main_courses')
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
                            fill="white" />
                    </svg>
                @elseif($currentChildrenView == 'view_lesson')
                    @if ($content->content_type == 'video')
                        <svg class="w-12 h-12 text-primary dark:text-dark md:w-16 md:h-16"
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
                    @elseif ($content->content_type == 'quiz')
                        <svg class="w-12 h-12 text-primary dark:text-dark md:w-16 md:h-16"
                            width="42"
                            height="42"
                            viewBox="0 0 42 42"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.291016 20.8031C0.291016 9.61049 9.36438 0.537109 20.5569 0.537109H34.4298C38.611 0.537109 42.0005 3.92665 42.0005 8.10787V20.2142C42.0005 31.732 32.6635 41.069 21.1458 41.069H20.557C9.36439 41.069 0.291016 31.9956 0.291016 20.8031Z"
                                fill="#CCCCCC" />
                            <path fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M25.9233 9.59144C25.7385 9.40659 25.488 9.30273 25.2267 9.30273C24.9654 9.30273 24.7148 9.40659 24.5301 9.59144L12.4557 21.6729C12.3319 21.7967 12.2434 21.9513 12.1991 22.1208L10.8856 27.1524C10.7972 27.491 10.8949 27.8511 11.1422 28.0985C11.3895 28.346 11.7494 28.4437 12.0878 28.3552L17.1165 27.0409C17.2858 26.9967 17.4403 26.9081 17.5641 26.7842L29.6385 14.7028C30.0232 14.3179 30.0232 13.6937 29.6385 13.3088L25.9233 9.59144ZM14.0379 22.8778L25.2267 11.6825L27.5487 14.0058L16.3599 25.2011L13.217 26.0225L14.0379 22.8778Z"
                                fill="#033468" />
                            <path
                                d="M11.2947 30.3313C10.7506 30.3313 10.3096 30.7726 10.3096 31.317C10.3096 31.8614 10.7506 32.3027 11.2947 32.3027H30.9975C31.5416 32.3027 31.9826 31.8614 31.9826 31.317C31.9826 30.7726 31.5416 30.3313 30.9975 30.3313H11.2947Z"
                                fill="#033468" />
                        </svg>
                    @endif
                @endif

                <div class="flex flex-col items-start justify-center gap-2">
                    <h2 class="text-base font-semibold md:text-xl">
                        {{ $content->title }}</h2>
                    <p class="text-xs md:tex-sm">
                        {{ $content->sub_title }}</p>
                </div>
            </div>
            @if ($currentChildrenView == 'one_course')
                <div class="flex gap-2">
                    <button
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
                    </button>
                </div>
            @elseif($currentChildrenView == 'view_lesson')
                <div class="flex gap-2">
                    <button
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
                    </button>
                </div>
            @endif

        </div>
        {{-- last row actions --}}
        <div></div>
    </div>
</div>
