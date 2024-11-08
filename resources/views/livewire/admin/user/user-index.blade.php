<div class="relative">
    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <x-mary-dropdown>
            <x-slot:trigger>
                <div class="flex items-center h-10 gap-2 px-4 py-3 rounded-full w-28 btn-primary dark:text-base-300 dark:bg-white btn-sm btn">
                    <svg class="h-4 font-semibold" viewBox="0 0 4 19"
                         fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.81732 1.96003C2.36953 1.96003 2.81719 2.40768 2.81719 2.9599C2.81719 3.51211 2.36953 3.95977 1.81732 3.95977C1.26511 3.95977 0.817449 3.51211 0.817449 2.9599C0.817449 2.40768 1.26511 1.96003 1.81732 1.96003ZM1.81732 8.24493C2.36953 8.24493 2.81719 8.69259 2.81719 9.2448C2.81719 9.79702 2.36953 10.2447 1.81732 10.2447C1.26511 10.2447 0.81745 9.79702 0.81745 9.2448C0.81745 8.69259 1.26511 8.24493 1.81732 8.24493ZM1.81732 14.5298C2.36953 14.5298 2.81719 14.9775 2.81719 15.5297C2.81719 16.0819 2.36954 16.5296 1.81732 16.5296C1.26511 16.5296 0.81745 16.0819 0.81745 15.5297C0.81745 14.9775 1.26511 14.5298 1.81732 14.5298Z"
                              fill="currentColor" stroke="currentColor"
                              stroke-width="1.14271"/>
                    </svg>
                    المزيد
                </div>
            </x-slot:trigger>
            <x-mary-menu-item title="الأدوار"
                              href="{{ route('admin.role.index') }}"
                              wire:navigate class="text-primary"/>
        </x-mary-dropdown>
        <div class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 h-10 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-neutral">
        </div>
    </div>

    <div class="mt-10">
        <x-mary-header title="المستخدمين" subtitle="إدارة المستخدمين" separator
                       progress-indicator>
            <x-slot name="actions">
                <x-mary-button icon="o-plus" class="btn-primary btn-circle"
                               @click="$dispatch('user-create')"/>
            </x-slot>
        </x-mary-header>

        <div class="overflow-table">
            <x-mary-table
                    :headers="$headers"
                    :rows="$users ?? []" :sort-by="$sortBy"
                    with-pagination
                    :per-page-values="$perPageOptions" per-page="perPage"
                    class="[&_th>*]:!text-black [&_th>*]:!inline-flex [&_th>*]:!font-bold"
                    show-empty-text empty-text="{{ __('no_data_found') }}">

                @scope('actions', $user)
                <x-mary-dropdown right top>
                    <x-slot:trigger>
                        <x-mary-button class="btn-circle btn-ghost">
                            <svg class="h-6 text-primary" viewBox="0 0 4 19"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.81732 1.96003C2.36953 1.96003 2.81719 2.40768 2.81719 2.9599C2.81719 3.51211 2.36953 3.95977 1.81732 3.95977C1.26511 3.95977 0.817449 3.51211 0.817449 2.9599C0.817449 2.40768 1.26511 1.96003 1.81732 1.96003ZM1.81732 8.24493C2.36953 8.24493 2.81719 8.69259 2.81719 9.2448C2.81719 9.79702 2.36953 10.2447 1.81732 10.2447C1.26511 10.2447 0.81745 9.79702 0.81745 9.2448C0.81745 8.69259 1.26511 8.24493 1.81732 8.24493ZM1.81732 14.5298C2.36953 14.5298 2.81719 14.9775 2.81719 15.5297C2.81719 16.0819 2.36954 16.5296 1.81732 16.5296C1.26511 16.5296 0.81745 16.0819 0.81745 15.5297C0.81745 14.9775 1.26511 14.5298 1.81732 14.5298Z"
                                      fill="currentColor" stroke="currentColor"
                                      stroke-width="1.14271"/>
                            </svg>
                        </x-mary-button>
                    </x-slot:trigger>

                    @if ($this->showArchived)
                        <x-mary-menu-item title="إعادة تنشيط"
                                          icon="o-arrow-path"
                                          class="text-primary"
                                          wire:click="restore({{ $user['id'] }})"
                                          wire:confirm="{{ __('are_you_sure_restore') }}"/>
                    @else
                        @if ($user->role_id != 1)
                            <x-mary-menu-item title="ارشفة"
                                              icon="o-trash"
                                              class="text-error"
                                              wire:click="delete({{ $user['id'] }})"
                                              wire:confirm="{{ __('are_you_sure_delete') }}"/>
                        @endif

                        <x-mary-menu-item title="تعديل" icon="o-pencil"
                                          href="{{ route('admin.user.edit', $user['id']) }}"
                                          wire:navigate class="text-info"/>
                        <x-mary-menu-item title="عرض" icon="o-eye"
                                          href="{{ route('admin.user.view', $user['id']) }}"
                                          wire:navigate class="text-primary"/>
                    @endif


                </x-mary-dropdown>
                @endscope
            </x-mary-table>
        </div>
    </div>

    <livewire:admin.user.user-create/>
</div>
