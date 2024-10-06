<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;

class UserIndex extends Component
{
    use WithPagination, Toast;
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
        // $this->medicalCenters = MedicalCenter::all();
        // $this->medicalCenters = Cache::remember('medical_centers', 60 * 60, function () {
        //     return MedicalCenter::all();
        // });
        // $this->treatments = Treatment::all();
        $this->successMessage = __('success');
        $this->archivedMessage = __('archived');
    }


    public function render()
    {
        return view('livewire.admin.user.user-index')->layout('layouts.admin');
    }

    public function users()
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
            // ->when($this->medicalCenterId > 0, function ($query) {
            //     $query->whereHas('medicalCenters', function ($query) {
            //         $query->where('id', $this->medicalCenterId);
            //     });
            // })
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
}
