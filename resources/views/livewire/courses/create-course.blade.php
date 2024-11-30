<div class="relative">
    <div class="w-full">
        {{-- nvigation line --}}
        <div class="flex items-center justify-end gap-2 text-xs md:text-base">
            {{--        <x-mary-dropdown>--}}
            {{--            <x-slot:trigger>--}}
            <div
                    class="flex items-center h-10 gap-2 px-4 py-3 rounded-full w-28 btn-primary dark:text-base-300 dark:bg-white btn-sm btn">
                {{--                <svg class="h-4 font-semibold"--}}
                {{--                     viewBox="0 0 4 19"--}}
                {{--                     fill="none"--}}
                {{--                     xmlns="http://www.w3.org/2000/svg">--}}
                {{--                    <path--}}
                {{--                            d="M1.81732 1.96003C2.36953 1.96003 2.81719 2.40768 2.81719 2.9599C2.81719 3.51211 2.36953 3.95977 1.81732 3.95977C1.26511 3.95977 0.817449 3.51211 0.817449 2.9599C0.817449 2.40768 1.26511 1.96003 1.81732 1.96003ZM1.81732 8.24493C2.36953 8.24493 2.81719 8.69259 2.81719 9.2448C2.81719 9.79702 2.36953 10.2447 1.81732 10.2447C1.26511 10.2447 0.81745 9.79702 0.81745 9.2448C0.81745 8.69259 1.26511 8.24493 1.81732 8.24493ZM1.81732 14.5298C2.36953 14.5298 2.81719 14.9775 2.81719 15.5297C2.81719 16.0819 2.36954 16.5296 1.81732 16.5296C1.26511 16.5296 0.81745 16.0819 0.81745 15.5297C0.81745 14.9775 1.26511 14.5298 1.81732 14.5298Z"--}}
                {{--                            fill="currentColor"--}}
                {{--                            stroke="currentColor"--}}
                {{--                            stroke-width="1.14271"/>--}}
                {{--                </svg>--}}
                {{--                المزيد--}}
            </div>
            {{--            </x-slot:trigger>--}}
            {{--            <x-mary-menu-item title="الاقسام"--}}
            {{--                              href="{{ route('admin.category.index') }}"--}}
            {{--                              wire:navigate--}}
            {{--                              class="text-primary" />--}}
            {{--            <x-mary-menu-item title="المراحل"--}}
            {{--                              href="{{ route('admin.stage.index') }}"--}}
            {{--                              wire:navigate--}}
            {{--                              class="text-primary" />--}}
            {{--        </x-mary-dropdown>--}}
            <div
                    class="flex flex-row-reverse flex-wrap items-center justify-start flex-1 gap-2 px-4 py-2 bg-dark rounded-3xl dark:bg-dark">
                <a href="{{ route('admin.course.index') }}"
                   wire:navigate
                   class="cursor-pointer">الكورسات</a>
                {{--            @foreach ($this->getFoldersTree() as $folder)--}}
                {{--                <div><svg class="w-6 h-6 text-gray-800 dark:text-white"--}}
                {{--                          aria-hidden="true"--}}
                {{--                          xmlns="http://www.w3.org/2000/svg"--}}
                {{--                          width="24"--}}
                {{--                          height="24"--}}
                {{--                          fill="none"--}}
                {{--                          viewBox="0 0 24 24">--}}
                {{--                        <path stroke="currentColor"--}}
                {{--                              stroke-linecap="round"--}}
                {{--                              stroke-linejoin="round"--}}
                {{--                              stroke-width="2"--}}
                {{--                              d="m10 16 4-4-4-4" />--}}
                {{--                    </svg>--}}
                {{--                </div>--}}
                {{--                <div wire:click="selectCourse({{ $folder->id }})"--}}
                {{--                     @click="$store.courses.reset()"--}}
                {{--                     class="cursor-pointer">{{ $folder->title }}</div>--}}
                {{--            @endforeach--}}
            </div>
            {{-- Back Button --}}
            <div>
                {{--            @if ($course)--}}
                {{--                <a wire:click="goBackCourse()"--}}
                {{--                   class="">--}}
                {{--                    <svg class="w-6 h-6 text-gray-800 dark:text-white"--}}
                {{--                         aria-hidden="true"--}}
                {{--                         xmlns="http://www.w3.org/2000/svg"--}}
                {{--                         width="24"--}}
                {{--                         height="24"--}}
                {{--                         fill="none"--}}
                {{--                         viewBox="0 0 24 24">--}}
                {{--                        <path stroke="currentColor"--}}
                {{--                              stroke-linecap="round"--}}
                {{--                              stroke-linejoin="round"--}}
                {{--                              stroke-width="2"--}}
                {{--                              d="m15 19-7-7 7-7" />--}}
                {{--                    </svg>--}}
                {{--                </a>--}}
                {{--            @endif--}}
            </div>
        </div>
        <div class="mt-10">
            <x-mary-header title="إضافة كورس" subtitle="إضافة كورس جديد"
                           separator
                           progress-indicator>
                <x-slot name="actions">
                    {{--                    <x-mary-button icon="o-plus" class="btn-primary btn-circle"--}}
                    {{--                                   @click="$dispatch('user-create')"/>--}}
                    {{--                    <x-mary-button icon="o-funnel"--}}
                    {{--                                   class="relative btn-circle"--}}
                    {{--                                   @click="$wire.showFilterDrawer = true">--}}
                    {{--                        @if ($this->filtersCount() > 0)--}}
                    {{--                            <x-mary-badge value="{{ $this->filtersCount() }}"--}}
                    {{--                                          class="absolute badge-warning -right-2 -top-2"/>--}}
                    {{--                        @endif--}}
                    {{--                    </x-mary-button>--}}
                </x-slot>
            </x-mary-header>
            <form wire:submit.prevent="save"
                  class="w-full ">

                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
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
                                  rows="2"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-dark/70 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="اكتب الوصف..."></textarea>
                        @error('form.description')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Teacher -->
                    <div class="mb-6">
                        <label for="status"
                               class="block mb-2 text-sm font-medium
                               text-gray-900 dark:text-white">المعلم</label>
                        <select wire:model="form.instructor_id"
                                id="instructor_id"
                                class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <Option value="0">اختر معلم</Option>
                            @foreach($this->getTeachers() as $teacher)
                                <option value="{{ $teacher->id }}">{{$teacher->first_name.' '.$teacher->last_name}}</option>
                            @endforeach
                        </select>
                        @error('form.instructor_id')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price, Discount, and Net Price -->
                    <div class="grid grid-cols-3 gap-4 mb-6"
                         x-data="{ price: 0, discount: 0, netPrice: 0 }">
                        <div>
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">السعر</label>
                            <input type="number"
                                   wire:model.live="form.price"
                                   id="price"
                                   step="1"
                                   x-model="price"
                                   :input="netPrice = price - (price * discount / 100)"
                                   class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('form.price')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="discount"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الخصم
                                (%)</label>
                            <input type="number"
                                   wire:model.live="form.discount"
                                   id="discount"
                                   step="1"
                                   min="0"
                                   max="100"
                                   x-model="discount"
                                   :input="netPrice = price - (price * discount / 100)"
                                   class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('form.discount')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="net_price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">السعر
                                النهائي</label>
                            <input type="number"
                                   wire:model="form.net_price"
                                   id="net_price"
                                   step="0.01"
                                   readonly
                                   x-init="$watch('netPrice', (value) => $wire.form.net_price = value)"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Featured Video -->
                    <div class="mb-6">
                        <label for="featured_video"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الفيديو
                            المميز</label>
                        <input type="url"
                               wire:model="form.featured_video"
                               id="featured_video"
                               class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('form.featured_video')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="status"
                               class="block mb-2 text-sm font-medium
                               text-gray-900 dark:text-white">الفئة</label>
                        <select wire:model="form.category_id"
                                id="category_id"
                                class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                           <option value="0">اختر الفئة</option>
                            @foreach($this->getCategories() as $category)
                               <option value="{{ $category->id }}">{{$category->name }}</option>
                           @endforeach
                        </select>
                        @error('form.category_id')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Stage -->
                    <div class="mb-6">
                        <label for="status"
                               class="block mb-2 text-sm font-medium
                               text-gray-900 dark:text-white">المرحلة</label>
                        <select wire:model="form.stage_id"
                                id="stage_id"
                                class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                           <option value="0">اختر المرحلة</option>
                            @foreach($this->getStages() as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                        @error('form.stage_id')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Status -->
                    <div class="mb-6">
                        <label for="status"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">حالة
                            الكورس</label>
                        <select wire:model="form.status"
                                id="status"
                                class="bg-dark/70 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="active">فعال</option>
                            <option value="inactive">غير فعال</option>
                        </select>
                        @error('form.status')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Thumbnail upload -->
                    <div class="mb-6">
                        <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="thumbnail">صورة
                            الكورس</label>
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
                </div>
                <!-- Dynamic Data Section -->
                <div class="mb-6">
                    <h3
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">
                        بيانات إضافية</h3>

                    <!-- Display existing data items as editable inputs -->
                    @foreach ($form->data as $index => $item)
                        <div class="grid grid-cols-3 gap-4 mb-4">
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
                    <div class="grid grid-cols-3 gap-4 mb-4">
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

                            @error('form.data.*.link')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
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
                            class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-20 px-5 py-2.5 text-center dark:bg-secondary hover:bg-secondary/80 ">
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
</div>
