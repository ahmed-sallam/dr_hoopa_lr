<div
    class="flex hover:scale-105  transition-all duration-300  flex-col md:flex-row items-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 w-full  p-4 gap-2">
    <div class="flex flex-col justify-between items-start p-4 leading-normal md:w-2/3 h-full">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $role->name }}</h5>
        <p class="text-sm font-light">{{ $role->users->count() }} مستخدم</p>
    </div>
    <div class="flex items-center justify-center gap-2">
        <button
            class="bg-info/80 hover:bg-info text-gray-300 font-bold py-2 px-4 rounded dark:bg-info/60 dark:hover:bg-info/70">
            تعديل
        </button>
        <button
            class="bg-primary/80 hover:bg-primary text-gray-300 font-bold py-2 px-4 rounded dark:bg-primary/60 dark:hover:bg-primary/70">
            الصلاحيات
        </button>
    </div>
</div>
