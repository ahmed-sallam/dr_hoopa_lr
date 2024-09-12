<div class="relative">
    {{-- nvigation line --}}
    <div class="flex items-center justify-end gap-2">
        <div
            class="flex items-center gap-2 justify-start bg-gray-100 py-2 rounded-3xl dark:bg-gray-800 px-4 flex-1 flex-row-reverse">
            <div href="{{ route('user.index') }}" wire:navigate class="cursor-pointer">المستخدمين</div>
            {{-- @foreach ($this->getFoldersTree() as $folder)
                <div><svg class="w-6
                h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m10 16 4-4-4-4" />
                    </svg>
                </div>
                <div wire:click="selectCourse({{ $folder->id }})" class="cursor-pointer">{{ $folder->title }}</div>
            @endforeach --}}
        </div>
        {{-- Back Button --}}
        <div>
            {{-- @if ($user)
                <a href="{{ route('user.index') }}" wire:navigate class="">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 19-7-7 7-7" />
                    </svg>
                </a>
            @endif --}}
        </div>
    </div>

    {{-- main contetn --}}
    <div class="grid lg:grid-cols-12 gap-4 mt-6 lg:mt-10 w-full">
        {{-- right side --}}
        <div class="lg:col-span-4 bg-gray-100 dark:bg-gray-800 rounded-lg p-3">
            <ul class="space-y-2">
                <li @click="$wire.selectTab('users')"
                    class="px-6 py-3 flex items-center justify-start gap-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg {{ $this->selectedTab == 'users' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                    <svg class="w-6 h-6  dark:text-white text-gray-800 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 16 4 10 10 4" />
                    </svg>
                    المستخدمون
                </li>
                <li @click="$wire.selectTab('roles')"
                    class="px-6 py-3 flex items-center justify-start gap-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg {{ $this->selectedTab == 'roles' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 16 4 10 10 4" />
                    </svg>
                    الادوار
                </li>
            </ul>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            @if ($this->selectedTab == 'users')
                <button
                    class="flex items-center gap-2 justify-center w-full py-2 rounded-lg bg-primary/70 hover:bg-primary/80 dark:bg-primary/60 dark:hover:bg-primary/70 text-gray-300">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                    اضف مستخدم
                </button>
            @endif
            @if ($this->selectedTab == 'roles')
                <button
                    class="flex items-center gap-2 justify-center w-full py-2 rounded-lg bg-primary/70 hover:bg-primary/80 dark:bg-primary/60 dark:hover:bg-primary/70 text-gray-300">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                    اضف دور
                </button>
            @endif
        </div>

        {{-- left side --}}
        <div class="lg:col-span-8 p-4 gap-4 flex  flex-col items-start justify-start">
            @if ($this->selectedTab === 'users')
                @foreach ($this->users() as $user)
                    <livewire:users.components.user-row :$user :key="$user->id" />
                @endforeach
            @elseif ($this->selectedTab === 'roles')
                @foreach ($this->roles() as $role)
                    @livewire('users.components.role-row', ['role' => $role, 'key' => $role->id])
                @endforeach
            @endif
        </div>
    </div>

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
