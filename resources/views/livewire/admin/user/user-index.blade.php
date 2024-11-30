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
                <x-mary-button icon="o-funnel"
                               class="relative btn-circle"
                               @click="$wire.showFilterDrawer = true">
                    @if ($this->filtersCount() > 0)
                        <x-mary-badge value="{{ $this->filtersCount() }}"
                                      class="absolute badge-warning -right-2 -top-2" />
                    @endif
                </x-mary-button>
            </x-slot>
        </x-mary-header>
        <x-mary-drawer wire:model="showFilterDrawer"
                       wire:ignore.self
                       class="w-11/12 lg:w-1/3 "
                       title="تصفية"
                       with-close-button
                       right
                       separator>
            <div class="space-y-2">
                <x-mary-input placeholder="بحث"
                              wire:model.blur="searchWord" />
                <x-mary-select label="نوع المستخدم"
                               :options="$roles"
                               placeholder="اختر الدور"
                               placeholder-value="0"
                               wire:model.live="roleId" />

                <x-mary-toggle label="عرض المستخدمين تم ارشفتهم"
                               wire:model.live="showArchived"
                               class="mt-2 focus:bg-primary/10 focus:border-primary focus:outline-primary focus-within:outline-primary"
                               right
                               tight />
            </div>
            <x-slot:actions>
                @if ($this->filtersCount() > 0)
                    <x-mary-button label="إعادة ضبط"
                                   wire:click="clearFilters"
                                   class="btn-warning " />
                @endif
                <x-mary-button label="تم"
                               @click="$wire.showFilterDrawer = false"
                               class="btn-primary " />
            </x-slot:actions>
        </x-mary-drawer>
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
                        <x-mary-menu-item title="تغيير كلمة المرور" 
                                          icon="o-key" 
                                         @click="$dispatch('show-change-password-modal', { userId: {{ $user['id'] }} })"
                                          class="text-warning"/>
                    @endif


                </x-mary-dropdown>
                @endscope
            </x-mary-table>
        </div>
    </div>

    <livewire:admin.user.user-create/>

    {{-- Change Password Modal --}}
    <div x-data="{
    oldPassword: '',
    newPassword: '',
    confirmPassword: '',
    userId: null,

    showModal(userId) {
        this.userId = userId;
        this.oldPassword = '';
        this.newPassword = '';
        this.confirmPassword = '';
        $wire.set('showChangePasswordModal', true);
    },

    changePassword() {
        console.log('Changing password for user ID:', this.userId);
        $wire.set('oldPassword', this.oldPassword);
        $wire.set('newPassword', this.newPassword);
        $wire.set('confirmPassword', this.confirmPassword);
        $wire.call('changePassword');
    }
}">
        <x-mary-modal
                x-show="$wire.showChangePasswordModal"
                wire:model="showChangePasswordModal"
                title="تغيير كلمة المرور"
                @close="$wire.set('showChangePasswordModal', false)"
        >
            <div class="space-y-4">
{{--                <x-mary-input--}}
{{--                        label="كلمة المرور الحالية"--}}
{{--                        type="password"--}}
{{--                        x-model="oldPassword"--}}
{{--                        wire:model="oldPassword"--}}
{{--                />--}}

                <x-mary-input
                        label="كلمة المرور الجديدة"
                        type="password"
                        x-model="newPassword"
                        wire:model="newPassword"
                />

                <x-mary-input
                        label="تأكيد كلمة المرور الجديدة"
                        type="password"
                        x-model="confirmPassword"
                        wire:model="confirmPassword"
                />

            </div>

            <x-slot:actions>
                <x-mary-button label="إلغاء" @click="$wire.set('showChangePasswordModal', false)" />
                <x-mary-button
                        label="تغيير كلمة المرور"
                        class="btn-primary !ms-2"
                        @click="changePassword()"
                        wire:loading.attr="disabled"
                />
            </x-slot:actions>
        </x-mary-modal>
    </div>
</div>
