<?php

namespace App\Livewire\Admin;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class AbandonedCartIndex extends Component
{
    use WithPagination;

    public string $title = 'المالية';
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

    public bool $showFilterDrawer = false;
    public Collection $courses;
    public int $courseId = 0;

    public function mount()
    {
        // $this->authorize('viewAny', User::class);
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.first_name', 'label' => 'الاسم الاول'],
            ['key' => 'user.last_name', 'label' => 'الاسم الأخير'],
            ['key' => 'course.title', 'label' => 'الكورس'],
            ['key' => 'course.price', 'label' => 'السعر'],
            ['key' => 'course.discount', 'label' => 'الخصم'],
            ['key' => 'course.net_price', 'label' => 'السعر المبلغ المتبقي'],
            ['key' => 'created_at', 'label' => 'تاريخ الاضافة'],

        ];
        $this->perPageOptions = [10, 20, 50, 100];
        $this->perPage = $this->perPageOptions[0];
        $this->sortBy = ['column' => 'id', 'direction' => 'asc', 'class' => 'text-red-500'];

        $this->courses = Course::all();
    }

    public function render()
    {
        return view('livewire.admin.abandoned-cart-index')->layout('layouts.finance');
    }

    public function carts()
    {
        return Cart::whereHas('user', function ($query) {
            $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($this->searchWord) . '%'])
                ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($this->searchWord) . '%']);
        })
            ->when($this->courseId > 0, function ($query) {
                $query->whereHas('course', function ($query) {
                    $query->where('id', $this->courseId);
                });
            })


            ->orderBy(...array_values($this->sortBy))
            ->paginate($this->perPage);
    }

    public function filtersCount(): int
    {
        $filters = [
            $this->searchWord !== '',
            $this->courseId > 0,
        ];
        return count(array_filter($filters));
    }

    public function clearFilters(): void
    {
        $this->courseId = 0;
        $this->searchWord = '';
    }

}
