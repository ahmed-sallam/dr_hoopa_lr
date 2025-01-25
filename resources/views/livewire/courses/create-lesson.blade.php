<div class="w-full" x-on:lesson-saved="window.history.back()">
    <div class="flex items-center justify-end gap-2 text-xs md:text-base">
        {{--        <x-mary-dropdown>--}}
        {{--            <x-slot:trigger>--}}
        <div
                class="flex items-center h-10 gap-2 px-4 py-3 rounded-full w-28 btn-primary dark:text-base-300 dark:bg-white btn-sm btn">

        </div>

        <div
                class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-dark">
            <a href="{{ route('admin.course.index') }}"
               wire:navigate
               class="cursor-pointer">الكورسات</a>
            @foreach ($this->getFoldersTree() as $folder)
            <div>
                <svg class="w-6 h-6 text-gray-800 dark:text-white"
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
                          d="m10 16 4-4-4-4"/>
                </svg>
            </div>
            <a href="{{ route('admin.course.view', $folder->id) }}"
               wire:navigate
               class="cursor-pointer">{{ $folder->title }}</a>
            @endforeach
        </div>
        {{-- Back Button --}}
        <div>
        </div>
    </div>
    <div class="mt-10">
        <x-mary-header title="{{$lesson ?  'تعديل درس': 'إضافة درس'}}"
                       subtitle="{{$lesson ?  'تعديل درس ' : 'إضافة درس جديد'}}"
                       separator
                       progress-indicator>
            <x-slot name="actions">
            </x-slot>
        </x-mary-header>
        <form wire:submit.prevent="save"
              class="w-full">
            <!-- Thumbnail upload -->
            <div class="mb-6">
                <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="thumbnail">صورة
                    المحتوى</label>
                <div class="flex items-center justify-center w-full"
                     x-data="{ dragOver: false }">
                    <label for="dropzone-file"
                           class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-dark/70 dark:hover:bg-gray-800 dark:bg-dark hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 "
                           :class="{ 'border-blue-500 bg-blue-50': dragOver }"
                           @dragover.prevent="dragOver = true"
                           @dragleave.prevent="dragOver = false"
                           @drop.prevent="dragOver = false; $wire.upload('form.thumbnail', $event.dataTransfer.files[0])">
                        <div
                                class="flex flex-col items-center justify-center pt-5 pb-6 ">
                            @if ($form && $form->thumbnail)
                                @if (is_string($form->thumbnail))
                                    <img src="{{ asset('storage/' . $form->thumbnail) }}"
                                         alt="Thumbnail preview"
                                         class="w-full mb-4 max-h-40">
                                @else
                                    <img src="{{ $form->thumbnail->temporaryUrl() }}"
                                         alt="Thumbnail preview"
                                         class="w-full mb-4 max-h-40">
                                @endif
                            @else
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 20 16">
                                    <path stroke="currentColor"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                            @endif
                            <p
                                    class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">انقر
                                لتحميل</span> أو اسحب وأفلت
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                SVG,
                                PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>
                        <input id="dropzone-file"
                               type="file"
                               class="hidden"
                               wire:model="form.thumbnail"
                               accept="image/*"/>
                    </label>
                </div>

                @error('form.thumbnail')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Title -->
            <div class="mb-6">
                <label for="title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
                <input type="text"
                       wire:model="form.title"
                       id="title"
                       class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('form.title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Sub Title -->
            <div class="mb-6">
                <label for="sub_title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان
                    الفرعي</label>
                <input type="text"
                       wire:model="form.sub_title"
                       id="sub_title"
                       class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('form.sub_title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6"
                 wire:ignore>
                <label for="description"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الوصف</label>
                <textarea wire:model="form.description"
                          id="description"
                          rows="4"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-dark/70 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="اكتب الوصف..."></textarea>
                @error('form.description')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Featured Video -->
            <div class="mb-6">
                <label for="content_url"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رابط
                    المحتوى</label>
                <input type="url"
                       wire:model="form.content_url"
                       id="content_url"
                       class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('form.content_url')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-2 md:gap-4">
                <!-- Status -->
                <div class="mb-6">
                    <label for="status"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">حالة
                        المحتوى</label>
                    <select wire:model="form.status"
                            id="status"
                            class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="active"
                                selected>فعال
                        </option>
                        <option value="inactive">غير فعال</option>
                    </select>
                    @error('form.status')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Content Type -->
                <div class="mb-6">
                    <label for="content_type"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع
                        المحتوى</label>
                    <select wire:model="form.content_type"
                            id="content_type"
                            class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="video"
                                selected>فيديو
                        </option>
                        <option value="quiz">تدريب</option>
                        <option value="item">اخرى</option>
                    </select>
                    @error('form.content_type')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="grid grid-cols-2 gap-2 md:gap-4">
                <!-- Is Premimum -->
                <div class="mb-6">
                    <label for="is_premium"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">محتوى
                        مدفوع</label>
                    <select wire:model="form.is_premium"
                            id="is_premium"
                            class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{ true }}"
                                selected>مدفوع
                        </option>
                        <option value="{{ false }}">مجاني</option>
                    </select>
                    @error('form.is_premium')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Order -->
                <div class="mb-6">
                    <label for="order"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ترتيب
                        العرض</label>
                    <select wire:model="form.order"
                            id="order"
                            class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach (range(0, 100) as $index)
                            <option value="{{ $index }}">
                                {{ $index }}</option>
                        @endforeach
                    </select>
                    @error('form.order')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Dynamic Data Section -->
            <div class="mb-6">
                <h3
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">
                    بيانات إضافية</h3>

                <!-- Display existing data items as editable inputs -->
                @foreach ($form->data as $index => $item)
                    <div class="grid grid-cols-3 gap-2 mb-4 md:gap-4">
                        <div>
                            <label for="data_svg_{{ $index }}"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SVG</label>
                            <input type="text"
                                   wire:model="form.data.{{ $index }}.svg"
                                   id="data_svg_{{ $index }}"
                                   class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="data_title_{{ $index }}"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
                            <input type="text"
                                   wire:model="form.data.{{ $index }}.title"
                                   id="data_title_{{ $index }}"
                                   class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="data_link_{{ $index }}"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الرابط</label>
                            <input type="url"
                                   wire:model="form.data.{{ $index }}.link"
                                   id="data_link_{{ $index }}"
                                   class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="button"
                                wire:click="removeDataItem({{ $index }})"
                                class="text-white bg-danger/70 hover:bg-danger/80 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-danger/60 dark:hover:bg-danger/70 ">
                            حذف
                        </button>
                    </div>
                @endforeach

                <!-- Add new data item -->
                <div class="grid grid-cols-3 gap-2 mb-4 md:gap-4">
                    <div>
                        <label for="newDataSvg"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SVG</label>
                        <input type="text"
                               wire:model="form.newDataSvg"
                               id="newDataSvg"
                               class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="newDataTitle"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
                        <input type="text"
                               wire:model="form.newDataTitle"
                               id="newDataTitle"
                               class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="newDataLink"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الرابط</label>
                        <input type="url"
                               wire:model="form.newDataLink"
                               id="newDataLink"
                               class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <button type="button"
                        wire:click="addDataItem"
                        class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-secondary hover:bg-secondary/80 ">
                    إضافة
                    عنصر
                </button>
            </div>

            <div class="flex flex-row gap-2 ">

                <button type="submit"
                        class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-20 px-5 py-2.5 text-center dark:bg-secondary  ">
                    حفظ
                </button>
                <button type="button"
                        wire:click="resetForm"
                        class="text-white bg-yellow-400 hover:bg-yellow-500  font-medium rounded-lg text-sm w-32 px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 ">
                    إعادة
                    الإعداد
                </button>
                <!-- @click="$store.courses.reset(); $wire.dispatch('reset-form')" -->
                <button type="button"
                        @click="window.history.back()"
                        class="text-white bg-danger/70 hover:bg-danger/80 focus:ring-4   font-medium rounded-lg text-sm w-20 px-5 py-2.5 text-center dark:bg-danger/60 dark:hover:bg-danger/70 ">
                    إلغاء
                </button>
            </div>
        </form>
    </div>
</div>
