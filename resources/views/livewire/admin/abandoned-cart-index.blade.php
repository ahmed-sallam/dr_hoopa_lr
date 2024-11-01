<div>
    <div class="mt-10">
        <x-mary-header title=""
                       separator
                       progress-indicator>
            <x-slot:middle
                    class="!justify-end ">
                <x-mary-input placeholder="بحث"
                              wire:model.blur="searchWord"
                              wire:keydown.enter="carts"
                              class="">
                </x-mary-input>
            </x-slot:middle>
            <x-slot name="actions">
                <x-mary-button icon="o-funnel"
                               class="relative btn-circle"
                               @click="$wire.showFilterDrawer = true">
                    @if ($this->filtersCount() > 0)
                        <x-mary-badge value="{{ $this->filtersCount() }}"
                                      class="absolute badge-warning -right-2 -top-2"/>
                    @endif
                </x-mary-button>
                {{-- @can('create', User::class)
                    <x-mary-button icon="o-plus"
                        class="btn-primary btn-circle "
                        @click="$wire.showAddModal">
                    </x-mary-button>
                @endcan --}}

            </x-slot>
        </x-mary-header>

        <x-mary-drawer wire:model="showFilterDrawer"
                       wire:ignore.self
                       class="w-11/12 lg:w-1/3 "
                       title="تصفية"
                       with-close-button
                       right
                       separator>
            <div class="space-y-2">
                <x-mary-input placeholder="بحث"
                              wire:model.blur="searchWord"/>
                <x-mary-select label="الكورس"
                               :options="$courses"
                               placeholder="اختر الكورس"
                               placeholder-value="0"
                               option-label="title"
                               wire:model.live="courseId"/>


            </div>
            <x-slot:actions>
                @if ($this->filtersCount() > 0)
                    <x-mary-button label="إعادة ضبط"
                                   wire:click="clearFilters"
                                   class="btn-warning "/>
                @endif
                <x-mary-button label="تم"
                               @click="$wire.showFilterDrawer = false"
                               class="btn-primary "/>
            </x-slot:actions>
        </x-mary-drawer>
        <div class="overflow-table">

            <x-mary-table :headers="$headers"
                          :rows="$this->carts()"
                          with-pagination
                          per-page="perPage"
                          :sort-by="$sortBy"
                          {{-- :row-decoration="$this->getRowDecoration()" --}}
                          class="[&_th>*]:!text-black [&_th>*]:!inline-flex
            [&_th>*]:!font-bold "
                          :per-page-values="$perPageOptions"
                          show-empty-text
                          empty-text="{{ __('no_data_found') }}">


                @scope('cell_created_at', $row)
                {{ $row->created_at->format('Y-m-d') }}
                @endscope


            </x-mary-table>
        </div>

    </div>

</div>
