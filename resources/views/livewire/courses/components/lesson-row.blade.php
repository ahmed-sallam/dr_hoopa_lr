<div
        class="flex dark:bg-white/10 hover:scale-105  transition-all duration-200 ease-in-out
flex-col  md:items-center
border border-dark dark:border-white/25 hover:border-primary
dark:hover:border-primary rounded-lg bg-gray-100
shadow hover:bg-gray-200  dark:hover:bg-white/5 w-full p-4 ">

    {{-- Lesson title --}}
    <div class="flex items-center justify-between w-full">
        <div class="flex flex-row items-center h-full justify-between w-full">
            <div class="flex items-center">
                <div class="w-fit">
                    @if ($lesson->content_type == 'video')
                        <svg class="text-primary dark:text-dark"
                             width="43"
                             height="43"
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
                    @elseif($lesson->content_type == 'quiz')
                        <svg class="text-primary dark:text-dark"
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
                    @elseif($lesson->content_type == 'item')
                        <svg class="text-primary dark:text-dark"
                             width="43"
                             height="44"
                             viewBox="0 0 43 44"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.0224609 21.9092C0.0224609 10.1294 9.57183 0.580078 21.3516 0.580078H35.0324C39.433 0.580078 43.0003 4.14744 43.0003 8.548V21.7493C43.0003 33.6173 33.2992 43.2383 21.4312 43.2383C9.65144 43.2383 0.0224609 33.6889 0.0224609 21.9092Z"
                                    fill="#CCCCCC"/>
                            <path
                                    d="M31.6329 15.6273V15.376C31.6329 13.2652 31.6329 12.2098 31.1917 11.4036C30.8035 10.6944 30.1842 10.1178 29.4224 9.75649C28.5564 9.3457 27.4227 9.3457 25.1554 9.3457H16.5186C14.2512 9.3457 13.1175 9.3457 12.2515 9.75649C11.4898 10.1178 10.8704 10.6944 10.4823 11.4036C10.041 12.2098 10.041 13.2652 10.041 15.376V28.4417C10.041 30.5525 10.041 31.6079 10.4823 32.4141C10.8704 33.1233 11.4898 33.6999 12.2515 34.0612C13.1175 34.472 14.2512 34.472 16.5186 34.472H21.5117M21.5117 20.6525H15.439M20.1622 25.6778H15.439M26.2349 15.6273H15.439M28.9339 29.4467V22.537C28.9339 21.4962 29.8402 20.6525 30.9582 20.6525C32.0761 20.6525 32.9824 21.4962 32.9824 22.537V29.4467C32.9824 31.5283 31.1699 33.2157 28.9339 33.2157C26.698 33.2157 24.8855 31.5283 24.8855 29.4467V24.4215"
                                    stroke="#033468"
                                    stroke-width="1.09245"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                        </svg>
                    @endif
                </div>
                <div class="flex flex-col p-4">
                    @if ($lesson->content_type == 'item')
                        <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 cursor-pointer dark:text-white hover:text-primary hover:underline">
                            <a href="{{ $lesson->content_url }}"
                               target="_blank"> {{ $lesson->title }}</a>
                        </h5>
                    @else
                        <h5
                                href="{{ Route::is('admin.*') ? route('admin.course.lesson',
                    [$lesson->course_id, $lesson->id]) : route('client.lesson.view', [$lesson->course_id, $lesson->id]) }}"
                                wire:navigate
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 cursor-pointer dark:text-white hover:text-primary hover:underline">
                            {{ $lesson->title }}
                        </h5>
                    @endif

                    <h6 class="text-sm font-light ">{{ $lesson->sub_title }}</h6>
                </div>
            </div>

            @canany(['update', 'create'],$lesson)
                <x-mary-dropdown right>
                    <x-slot:trigger>
                        <svg class="h-8 cursor-pointer text-primary"
                             viewBox="0 0 5 19"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M2.42596 2.14149C2.98177 2.14149 3.43235 2.59206 3.43235 3.14788C3.43235 3.70369 2.98177 4.15427 2.42596 4.15427C1.87014 4.15427 1.41956 3.70369 1.41956 3.14788C1.41956 2.59206 1.87014 2.14149 2.42596 2.14149ZM2.42596 8.46738C2.98177 8.46738 3.43235 8.91796 3.43235 9.47377C3.43235 10.0296 2.98177 10.4802 2.42596 10.4802C1.87014 10.4802 1.41956 10.0296 1.41956 9.47377C1.41956 8.91796 1.87014 8.46738 2.42596 8.46738ZM2.42596 14.7933C2.98177 14.7933 3.43235 15.2438 3.43235 15.7997C3.43235 16.3555 2.98177 16.8061 2.42596 16.8061C1.87014 16.8061 1.41956 16.3555 1.41956 15.7997C1.41956 15.2438 1.87014 14.7933 2.42596 14.7933Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.15016"/>
                        </svg>
                    </x-slot:trigger>
                    @can('update',$lesson)
                        <x-mary-menu-item
                                href="{{ route('admin.course.edit-lesson',
['id' =>$lesson->course_id, 'lessonId' =>$lesson->id]) }}"
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
                                            d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/>
                                    <path d="m15 5 4 4"/>
                                </svg>
                                <p>تعديل</p>
                            </div>
                        </x-mary-menu-item>
                    @endcan
                    @can('delete',$lesson)
                        <x-mary-menu-item
                                x-on:click="show_delete_confirm = true">
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
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10"
                                          x2="10"
                                          y1="11"
                                          y2="17"/>
                                    <line x1="14"
                                          x2="14"
                                          y1="11"
                                          y2="17"/>
                                </svg>
                                <p>حذف</p>
                            </div>
                        </x-mary-menu-item>
                    @endcan
                </x-mary-dropdown>
            @endcanany
        </div>
        <div></div>
    </div>

    <div class="grid grid-cols-4 gap-2 w-full">
        <div class="rounded ">
            <div>
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.98042 7.95574C5.91614 7.94931 5.839 7.94931 5.76829 7.95574C4.23837 7.90431 3.02344 6.65081 3.02344 5.10804C3.02344 3.53312 4.29623 2.25391 5.87757 2.25391C7.45248 2.25391 8.7317 3.53312 8.7317 5.10804C8.72527 6.65081 7.51034 7.90431 5.98042 7.95574Z"
                          stroke="#033468" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M10.6402 3.53906C11.8873 3.53906 12.8901 4.54829 12.8901 5.78894C12.8901 7.00387 11.9259 7.99382 10.7238 8.03882C10.6723 8.03239 10.6145 8.03239 10.5566 8.03882"
                          stroke="#033468" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M2.76633 10.3276C1.2107 11.369 1.2107 13.066 2.76633 14.101C4.53409 15.2837 7.43322 15.2837 9.20098 14.101C10.7566 13.0596 10.7566 11.3625 9.20098 10.3276C7.43965 9.15122 4.54052 9.15122 2.76633 10.3276Z"
                          stroke="#033468" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M11.8809 13.8257C12.3437 13.7293 12.7808 13.5428 13.1408 13.2664C14.1436 12.5143 14.1436 11.2737 13.1408 10.5216C12.7872 10.2516 12.3565 10.0716 11.9001 9.96875"
                          stroke="#033468" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                Assigned 1400
            </div>
        </div>
    </div>
</div>
