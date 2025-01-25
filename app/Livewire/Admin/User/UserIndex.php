<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\On;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    use WithPagination, Toast;


    public string $title = 'المستخدمين';
    public string $logo = <<<'EOT'
 <svg xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="w-12 h-12 ">
                            <path d="M18 21a8 8 0 0 0-16 0"/>
                            <circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
EOT;



    public array $headers;
    public string $searchWord = '';
    public int $perPage;
    public array $perPageOptions;
    public array $sortBy;
    private $users;
    public Collection $roles;
    public string $successMessage = '';
    private string $archivedMessage = '';
    public bool $showArchived = false;
    public bool $showFilterDrawer = false;
    public int $roleId = 0;

    public $selectedUserId = null;
    public $oldPassword = '';
    public $newPassword = '';
    public $confirmPassword = '';
    public bool $showChangePasswordModal = false;

    public function updatedShowChangePasswordModal($value)
    {
        // Reset form when modal is closed
        if (!$value) {
            $this->reset(['selectedUserId', 'oldPassword', 'newPassword', 'confirmPassword']);
        }
    }






    public function mount()
    {
        // $this->authorize('viewAny', User::class);
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'first_name', 'label' => 'الاسم الاول'],
            ['key' => 'last_name', 'label' => 'الاسم الأخير'],
            ['key' => 'email', 'label' => 'البريد الإلكتروني'],
            ['key' => 'phone', 'label' => 'الهاتف'],
            ['key' => 'city', 'label' => 'المدينة'],
            ['key' => 'role.name', 'label' => 'نوع المستخدم', 'sortable' => false],
        ];
        $this->perPageOptions = [10, 20, 50, 100];
        $this->perPage = $this->perPageOptions[0];
        $this->sortBy = ['column' => 'id', 'direction' => 'asc', 'class' => 'text-red-500'];
        $this->roles = Role::all();

        $this->successMessage = __('success');
        $this->archivedMessage = __('archived');
    }


    #[On('user-create')]
    public function showCreateModal()
    {
        $this->dispatch('show-user-create-modal');
    }

    public function render()
    {
        $users = $this->users();
        return view('livewire.admin.user.user-index', [
            'users' => $users
        ])->layout('layouts.admin', ['title' => $this->title, 'logo' => $this->logo]);
    }

    protected function users()
    {
        return User::where(function ($query) {
            $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhereRaw('LOWER(phone) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhereRaw('LOWER(city) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhere('id', 'like', '%' . $this->searchWord . '%');
        })
            ->when($this->roleId > 0, function ($query) {
                $query->whereHas('role', function ($query) {
                    $query->where('id', $this->roleId);
                });
            })

            ->when($this->showArchived, function ($query) {
                $query->onlyTrashed();
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate($this->perPage);
    }


    public function filtersCount(): int
    {
        $filters = [
            $this->searchWord !== '',
            $this->roleId > 0,
            // $this->medicalCenterId > 0,
            $this->showArchived === true
        ];
        return count(array_filter($filters));
    }

    public function clearFilters(): void
    {
        $this->roleId = 0;
        // $this->medicalCenterId = 0;
        $this->searchWord = '';
        $this->showArchived = false;
    }

    public function delete(int $id): void
    {
        $user = User::findOrFail($id);
        // $this->authorize('delete', $user);
        $user->delete();
        $this->warning(
            $this->archivedMessage,
            position: 'bottom-end',
            icon: 'c-trash',
            css: 'bg-warning text-white'
        );
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        // $this->authorize('restore', $user);
        $user->restore();
    }

    #[On('show-change-password-modal')]
    public function showChangePasswordModalF($userId)
    {
        $this->selectedUserId = $userId;
        $this->showChangePasswordModal = true;
    }

    public function changePassword()
    {
        $validationRules = [
//            'oldPassword' => 'required',
            'newPassword' => [
                'required', 
                'min:8', 
//                'different:oldPassword',
//                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'confirmPassword' => 'required|same:newPassword'
        ];

        $validationMessages = [
            'oldPassword.required' => 'كلمة المرور الحالية مطلوبة',
            'newPassword.required' => 'كلمة المرور الجديدة مطلوبة',
            'newPassword.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'newPassword.different' => 'كلمة المرور الجديدة يجب أن تكون مختلفة عن كلمة المرور القديمة',
            'newPassword.regex' => 'كلمة المرور يجب أن تحتوي على حرف كبير وصغير ورقم ورمز خاص',
            'confirmPassword.required' => 'تأكيد كلمة المرور مطلوب',
            'confirmPassword.same' => 'تأكيد كلمة المرور غير متطابق'
        ];

        $this->validate($validationRules, $validationMessages);

        $user = User::findOrFail($this->selectedUserId);

        // Verify old password
//        if (!Hash::check($this->oldPassword, $user->password)) {
//            $this->addError('oldPassword', 'كلمة المرور القديمة غير صحيحة');
//            return;
//        }

        // Update password
        $user->update([
            'password' => Hash::make($this->newPassword)
        ]);

        $this->reset(['selectedUserId', 'oldPassword', 'newPassword', 'confirmPassword']);
        $this->showChangePasswordModal = false;
        $this->success('تم تغيير كلمة المرور بنجاح');
    }
}
