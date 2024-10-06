<div class="relative">
    {{-- <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <div
            class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-neutral">
            <a href="{{ route('admin.user.index') }}"
                wire:navigate
                class="cursor-pointer">المستخدمين</a>

        </div>
    </div> --}}


    <div class="mt-10">
        <x-mary-header separator
            progress-indicator>

            <x-slot:title>
                <div class="flex items-center justify-start gap-2 ">
                    <img src="{{ Storage::url($user->avatar) }}"
                        class="w-12 h-12 rounded-lg"
                        alt="{{ $user->first_name . ' avatar' }}" />
                    <div>
                        <h2>{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                        </h2>
                        <p class="text-sm font-light">{{ $user->role->name }}
                        </p>
                    </div>
                </div>
            </x-slot:title>

            <x-slot name="actions">
                {{-- <x-mary-button icon="o-funnel"
                    class="relative btn-circle"
                    @click="$wire.showFilterDrawer = true">
                    @if ($this->filtersCount() > 0)
                        <x-mary-badge value="{{ $this->filtersCount() }}"
                            class="absolute badge-warning -right-2 -top-2" />
                    @endif
                </x-mary-button> --}}
                {{-- @can('create', User::class)
                    <x-mary-button icon="o-plus"
                        class="btn-primary btn-circle "
                        @click="$wire.showAddModal">
                    </x-mary-button>
                @endcan --}}
                <x-mary-dropdown right>
                    <x-slot:trigger>
                        <x-mary-button class="btn-circle btn-ghost">
                            <svg class="h-6 text-primary"
                                viewBox="0 0 4 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.81732 1.96003C2.36953 1.96003 2.81719 2.40768 2.81719 2.9599C2.81719 3.51211 2.36953 3.95977 1.81732 3.95977C1.26511 3.95977 0.817449 3.51211 0.817449 2.9599C0.817449 2.40768 1.26511 1.96003 1.81732 1.96003ZM1.81732 8.24493C2.36953 8.24493 2.81719 8.69259 2.81719 9.2448C2.81719 9.79702 2.36953 10.2447 1.81732 10.2447C1.26511 10.2447 0.81745 9.79702 0.81745 9.2448C0.81745 8.69259 1.26511 8.24493 1.81732 8.24493ZM1.81732 14.5298C2.36953 14.5298 2.81719 14.9775 2.81719 15.5297C2.81719 16.0819 2.36954 16.5296 1.81732 16.5296C1.26511 16.5296 0.81745 16.0819 0.81745 15.5297C0.81745 14.9775 1.26511 14.5298 1.81732 14.5298Z"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="1.14271" />
                            </svg>

                        </x-mary-button>
                    </x-slot:trigger>

                    @if ($user->role_id != 1)
                        <x-mary-menu-item title="ارشفة"
                            icon="o-trash"
                            class="text-error"
                            wire:click="delete({{ $user['id'] }})"
                            wire:confirm="{{ __('are_you_sure_delete') }}" />
                    @endif
                    <x-mary-menu-item title="تعديل"
                        icon="o-pencil"
                        href="{{ route('admin.user.edit', $user['id']) }}"
                        wire:navigate
                        class="text-info" />
                </x-mary-dropdown>
            </x-slot>
        </x-mary-header>

        <div class="grid grid-cols-4 gap-4 p-4 md:grid-cols-8 lg:grid-cols-12">
            <div class="col-span-1 font-semibold">الاسم الاول</div>
            <div class="col-span-3">{{ $user->first_name }}</div>
            <div class="col-span-1 font-semibold">اسم الاب</div>
            <div class="col-span-3">{{ $user->middle_name }}</div>
            <div class="col-span-1 font-semibold">الاسم الاخير</div>
            <div class="col-span-3">{{ $user->last_name }}</div>
            <div class="col-span-1 font-semibold">الايميل</div>
            <div class="col-span-3">{{ $user->email }}</div>
            <div class="col-span-1 font-semibold">الهاتف</div>
            <div class="col-span-3">{{ $user->phone }}</div>
            <div class="col-span-1 font-semibold">هاتف الاهل</div>
            <div class="col-span-3">{{ $user->guardian_phone }}</div>
            <div class="col-span-1 font-semibold">الجنس</div>
            <div class="col-span-3">{{ $user->gender }}</div>
            <div class="col-span-1 font-semibold">المحافظة</div>
            <div class="col-span-3">{{ $user->state }}</div>
            <div class="col-span-1 font-semibold">المدينة</div>
            <div class="col-span-3">{{ $user->city }}</div>
            <div class="col-span-1 font-semibold">العنوان</div>
            <div class="col-span-3">{{ $user->address }}</div>
            <div class="col-span-1 font-semibold">وصف العنوان</div>
            <div class="col-span-3">{{ $user->address_description }}</div>

        </div>


    </div>


</div>
