<div id="delete-course-confirm"
    tabindex="-1"
    data-modal-backdrop="static"
    class="flex items-center justify-center overflow-y-auto overflow-x-hidden bg-dark/50
fixed top-0 right-0 left-0 z-50
w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-3xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $editMode ? 'تعديل الدور  ' . $role->name : 'اضف دور جديد' }}
                </h3>
                <button wire:click="$parent.cancel()"
                    type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4"
                    wire:submit.prevent="save">
                    <!-- Sub Title -->
                    <div class="mb-6">
                        <label for="sub_title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اسم
                            الدور</label>
                        <input type="text"
                            wire:model="form.name"
                            id="sub_title"
                            class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('form.name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <hr />
                    <div class="overflow-y-auto h-96 hide-scrollbar">

                        @foreach ($permissions as $tableName => $permissionGroup)
                            <h3
                                class="mb-4 font-semibold text-gray-900 dark:text-white">
                                {{ $tableName }}</h3>
                            <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($permissionGroup as $permission)
                                    <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <input type="checkbox"
                                                id="permission_{{ $permission['id'] }}"
                                                wire:model="form.permissions.{{ $permission['id'] }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label
                                                for="permission_{{ $permission['id'] }}"
                                                class="w-full py-3 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $permission['name'] }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>
