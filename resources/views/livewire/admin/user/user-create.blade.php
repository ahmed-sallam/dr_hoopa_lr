<div>
    <x-mary-modal wire:model="showModal" title="إضافة مستخدم جديد"
                  box-class="w-full max-w-[1000px]">
        <div class=" grid lg:grid-cols-2 grid-cols-1 gap-4">
            <div class="grid grid-cols-2 gap-4">
                <x-mary-input label="الاسم الأول" wire:model="form.first_name" />
                <x-mary-input label="اسم الأب" wire:model="form.middle_name" />
            </div>
            <x-mary-input label="اسم العائلة" wire:model="form.last_name" />
            <x-mary-input label="البريد الإلكتروني" type="email" wire:model="form.email" />
            <x-mary-input label="رقم الهاتف" wire:model="form.phone" />
            <x-mary-input label="رقم هاتف ولي الأمر" wire:model="form.guardian_phone" />
            <x-mary-input label="العنوان" wire:model="form.address" />
            <div class="grid grid-cols-2 gap-4">
                <x-mary-input label="المدينة" wire:model="form.city" />
                <x-mary-input label="المنطقة" wire:model="form.state" />
            </div>
            <x-mary-textarea label="وصف العنوان" wire:model="form.address_description" />
            <x-mary-select 
                label="الجنس"
                wire:model="form.gender"
                :options="[['id' => 'male', 'name' => 'ذكر'], ['id' => 'female', 'name' => 'أنثى']]"
                option-label="name"
                option-value="id"
                placeholder="اختر الجنس"
            />
            <x-mary-input label="كلمة المرور" type="password" wire:model="form.password" />
            <x-mary-select 
                label="الدور"
                wire:model="form.role_id"
                :options="$roles"
                option-label="name"
                option-value="id"
                placeholder="اختر الدور"
            />
        </div>

        <x-slot:actions>
            <x-mary-button label="إلغاء" @click="$dispatch('hide-user-create-modal')" />
            <x-mary-button label="حفظ" class="btn-primary px-6 !ms-2"
                           wire:click="save" spinner="save" />
        </x-slot:actions>
    </x-mary-modal>
</div>
