<div class="w-full ">

    <x-mary-header separator
        progress-indicator>

        <x-slot:title>
            <div class="flex items-start justify-start gap-2 ">
                {{-- <img src="{{ Storage::url($user->avatar) }}"
                class="w-12 h-12 rounded-lg"
                alt="{{ $user->first_name . ' avatar' }}" /> --}}
                <div class="font-semibold">تعديل:</div>
                <div>
                    <h2> {{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                    </h2>
                    <p class="text-sm font-light">{{ $user->role->name }}
                    </p>
                </div>
            </div>
        </x-slot:title>

        <x-slot name="actions">

        </x-slot>
    </x-mary-header>

    <form wire:submit.prevent="save"
        class="grid w-full grid-cols-1 gap-4 p-4 lg:grid-cols-2">
        <!-- Avatar upload -->
        <div class="col-span-1 mb-6 lg:col-span-2">
            <label
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="avatar">الصورة الشخصية</label>
            <div class="flex items-center justify-center w-full"
                x-data="{ dragOver: false }">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-base-200 dark:hover:bg-gray-800 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 "
                    :class="{ 'border-blue-500 bg-blue-50': dragOver }"
                    @dragover.prevent="dragOver = true"
                    @dragleave.prevent="dragOver = false"
                    @drop.prevent="dragOver = false; $wire.upload('form.avatar', $event.dataTransfer.files[0])">
                    <div
                        class="flex flex-col items-center justify-center pt-5 pb-6 ">
                        @if ($form && $form->avatar)
                            @if (is_string($form->avatar))
                                <img src="{{ asset('storage/' . $form->avatar) }}"
                                    alt="avatar preview"
                                    class="w-full mb-4 max-h-40">
                            @else
                                <img src="{{ $form->avatar->temporaryUrl() }}"
                                    alt="avatar preview"
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
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                        @endif
                        <p
                            class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">انقر
                                لتحميل</span> أو اسحب وأفلت
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG,
                            PNG, JPG or GIF (MAX. 2MB)</p>
                    </div>
                    <input id="dropzone-file"
                        type="file"
                        class="hidden"
                        wire:model="form.avatar"
                        accept="image/*" />
                </label>
            </div>

            @error('form.avatar')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- First name -->
        <div class="mb-6">
            <label for="first_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الاسم
                الاول</label>
            <input type="text"
                wire:model="form.first_name"
                id="first_name"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.first_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>



        <!-- Midlle name -->
        <div class="mb-6">
            <label for="middle_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">اسم
                الاب</label>
            <input type="text"
                wire:model="form.middle_name"
                id="middle_name"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.middle_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Last name -->
        <div class="mb-6">
            <label for="last_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الاسم
                الاخير</label>
            <input type="text"
                wire:model="form.last_name"
                id="last_name"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.last_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Email  -->
        <div class="mb-6">
            <label for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">البريد
                الالكتروني</label>
            <input type="email"
                wire:model="form.email"
                id="email"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Phone  -->
        <div class="mb-6">
            <label for="phone"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الهاتف</label>
            <input type="text"
                wire:model="form.phone"
                id="phone"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.phone')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Guardian phone  -->
        <div class="mb-6">
            <label for="guardian_phone"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">هاتف
                الاهل</label>
            <input type="text"
                wire:model="form.guardian_phone"
                id="guardian_phone"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.guardian_phone')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Address  -->
        <div class="mb-6">
            <label for="address"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
            <input type="text"
                wire:model="form.address"
                id="address"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.address')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- City  -->
        <div class="mb-6">
            <label for="city"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">المدينة</label>
            <input type="text"
                wire:model="form.city"
                id="city"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.city')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- State  -->
        <div class="mb-6">
            <label for="state"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">المحافظة</label>
            <input type="text"
                wire:model="form.state"
                id="state"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.state')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <!-- Address Description  -->
        <div class="mb-6">
            <label for="address_description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">وصف
                العنوان</label>
            <input type="text"
                wire:model="form.address_description"
                id="address_description"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.address_description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>


        <!-- Sub Title -->
        {{-- <div class="mb-6">
            <label for="sub_title"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان
                الفرعي</label>
            <input type="text"
                wire:model="form.sub_title"
                id="sub_title"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.sub_title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div> --}}

        <!-- Description -->
        {{-- <div class="mb-6"
            wire:ignore>
            <label for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الوصف</label>
            <textarea wire:model="form.description"
                id="description"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-base-200 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="اكتب الوصف..."></textarea>
            @error('form.description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div> --}}

        <!-- Price, Discount, and Net Price -->
        {{-- <div class="grid grid-cols-3 gap-4 mb-6"
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
                    class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    :input="netPrice = price -
                        (price * discount / 100)"
                    class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div> --}}

        <!-- Featured Video -->
        {{-- <div class="mb-6">
            <label for="featured_video"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الفيديو
                المميز</label>
            <input type="url"
                wire:model="form.featured_video"
                id="featured_video"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('form.featured_video')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div> --}}

        <!-- Gender -->
        <div class="mb-6">
            <label for="gender"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الجنس</label>
            <select wire:model="form.gender"
                id="gender"
                class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="male">ذكر</option>
                <option value="female">انثى</option>
            </select>
            @error('form.gender')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Dynamic Data Section -->
        {{-- <div class="mb-6">
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
                            class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="data_title_{{ $index }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
                        <input type="text"
                            wire:model="form.data.{{ $index }}.title"
                            id="data_title_{{ $index }}"
                            class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="data_link_{{ $index }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الرابط</label>
                        <input type="url"
                            wire:model="form.data.{{ $index }}.link"
                            id="data_link_{{ $index }}"
                            class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div class="mb-4">
                    <button type="button"
                        wire:click="removeDataItem({{ $index }})"
                        class="text-white bg-danger/70 hover:bg-danger/80 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-danger/60 dark:hover:bg-danger/70 ">حذف</button>
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
                        class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="newDataTitle"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">العنوان</label>
                    <input type="text"
                        wire:model="form.newDataTitle"
                        id="newDataTitle"
                        class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="newDataLink"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الرابط</label>
                    <input type="url"
                        wire:model="form.newDataLink"
                        id="newDataLink"
                        class="bg-base-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @error('form.data.*.link')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="button"
                wire:click="addDataItem"
                class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-secondary hover:bg-secondary/80 ">إضافة
                عنصر</button>
        </div> --}}

        <div class="flex flex-row col-span-1 gap-2 lg:col-span-2 ">

            <button type="submit"
                class="text-white bg-secondary hover:bg-secondary/80 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-20 px-5 py-2.5 text-center dark:bg-secondary  ">حفظ</button>
            <button type="button"
                wire:click="resetForm"
                class="text-white bg-yellow-400 hover:bg-yellow-500  font-medium rounded-lg text-sm w-32 px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 ">إعادة
                الإعداد</button>
            <!-- @click="$store.courses.reset(); $wire.dispatch('reset-form')" -->
            <button type="button"
                x-on:click=" window.history.back();"
                {{-- wire:click="$parent.cancel" --}}
                class="text-white bg-danger/70 hover:bg-danger/80 focus:ring-4   font-medium rounded-lg text-sm w-20 px-5 py-2.5 text-center dark:bg-danger/60 dark:hover:bg-danger/70 ">إلغاء</button>
        </div>
    </form>



    @script
        <script>
            Livewire.on('goBack', function() {
                window.location.href = document.referrer;
                window.history.back();
            });
        </script>
    @endscript
</div>
