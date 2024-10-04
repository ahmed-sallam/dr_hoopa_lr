<div class="relative">
    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        <div
            class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-neutral">
            <a href="{{ route('client.courses.index') }}"
                wire:navigate
                class="cursor-pointer">الكورسات</a>

        </div>
    </div>


    <div role="tablist"
        class="mt-6 tabs">
        <a role="tab"
            class="tab">الكل</a>
        <a role="tab"
            class="tab tab-active">اولى ثانوي</a>
        <a role="tab"
            class="tab">ثانيه ثانوي</a>
    </div>

</div>
