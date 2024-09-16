<div
    class="flex hover:scale-105  transition-all duration-300  flex-col md:flex-row items-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 w-full  p-4">
    <img src="{{ Storage::url($user->avatar) }}" class="w-16 h-16 rounded-full " alt="User Avatar">
    <div class="flex flex-col justify-between items-start p-4 leading-normal md:w-2/3 h-full">
        <div class="flex flex-col items-center justify-center md:items-start md:justify-start">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->first_name }}
                {{ $user->last_name }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->email }} - {{ $user->role->name }}
            </p>
        </div>
    </div>
    <button
        class="bg-secondary hover:bg-secondary/80 text-gray-300 font-bold py-2 px-4 rounded dark:bg-secondary hover:bg-secondary/80">
        مشاهدة
    </button>
</div>
