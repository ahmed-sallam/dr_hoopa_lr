<div class="relative"
    x-data="{ show_delete_confirm: false, show_role_modal: false }">
    {{-- nvigation line --}}
    <div class="flex items-center justify-end gap-2">
        <div
            class="flex flex-row-reverse items-center justify-start flex-1 gap-2 px-4 py-2 bg-gray-100 rounded-3xl dark:bg-dark">
            <div href="{{ route('user.index') }}"
                wire:navigate
                class="cursor-pointer">المستخدمين</div>

        </div>
        {{-- Back Button --}}
        <div>

        </div>
    </div>

    {{-- main contetn --}}
    <div class="grid w-full gap-4 mt-6 lg:grid-cols-12 lg:mt-10">
        {{-- right side --}}
        <div class="p-3 bg-gray-100 rounded-lg lg:col-span-4 dark:bg-dark">
            <ul class="space-y-2">
                <li @click="$wire.selectTab('users')"
                    class="px-6 py-3 flex items-center justify-start gap-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg {{ $this->selectedTab == 'users' ? 'bg-gray-200 dark:bg-dark' : '' }}">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white "
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 16 4 10 10 4" />
                    </svg>
                    المستخدمون
                </li>
                <li @click="$wire.selectTab('roles')"
                    class="px-6 py-3 flex items-center justify-start gap-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg {{ $this->selectedTab == 'roles' ? 'bg-gray-200 dark:bg-dark' : '' }}">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white "
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 16 4 10 10 4" />
                    </svg>
                    الادوار
                </li>
            </ul>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-dark">
            @if ($this->selectedTab == 'users')
                <button
                    class="flex items-center justify-center w-full gap-2 py-2 text-gray-300 rounded-lg bg-secondary hover:bg-secondary/80 dark:bg-secondary">
                    <svg class="w-6 h-6 "
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                    اضف مستخدم
                </button>
            @endif
            @if ($this->selectedTab == 'roles')
                <button wire:click="openModal('role')"
                    class="flex items-center justify-center w-full gap-2 py-2 text-white rounded-lg bg-secondary hover:bg-secondary/80 dark:bg-secondary">
                    <svg class="w-6 h-6 "
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                    اضف دور
                </button>
            @endif
        </div>

        {{-- left side --}}
        <div
            class="flex flex-col items-start justify-start gap-4 p-4 lg:col-span-8">
            @if ($this->selectedTab === 'users')
                @foreach ($this->users() as $user)
                    <livewire:users.components.user-row :$user
                        :key="$user->id . 'users'" />
                @endforeach
            @elseif ($this->selectedTab === 'roles')
                @foreach ($this->roles() as $role)
                    <livewire:users.components.role-row :$role
                        :key="$role->id . 'roles ?>'" />
                @endforeach
            @endif
        </div>
    </div>





    {{-- Modals --}}
    @if ($activeModal == 'role')
        <livewire:users.components.role-modal :$permissions
            :role="$selectedRole" />
    @endif

    @script
        <script>
            window.addEventListener('update-url', event => {
                const url = new URL(window.location);
                url.searchParams.set('query', event.detail.query);
                window.history.pushState({}, '', url);
            });
        </script>
    @endscript
</div>
