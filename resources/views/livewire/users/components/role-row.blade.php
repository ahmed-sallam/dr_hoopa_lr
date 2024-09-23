<div
    class="flex flex-col items-center w-full gap-2 p-4 transition-all duration-300 border border-gray-200 rounded-lg shadow hover:scale-105 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700">
    <div
        class="flex flex-col items-start justify-between h-full p-4 leading-normal md:w-2/3">
        <h5
            class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $role->name }}</h5>
        <p class="text-sm font-light">{{ $role->users->count() }} مستخدم</p>
    </div>
    <div class="flex items-center justify-center gap-2">
        <button wire:click="$parent.openModal('role', {{ $role }})"
            x-on:click="show_role_modal=true"
            class="px-4 py-2 font-bold text-white rounded bg-info hover:bg-info/80 dark:bg-info/60 dark:hover:bg-info/70">
            تعديل
        </button>
        {{-- <button
            class="px-4 py-2 font-bold text-gray-300 rounded bg-secondary hover:bg-primary dark:bg-secondary hover:bg-secondary/80">
            الصلاحيات
        </button> --}}
    </div>
</div>
