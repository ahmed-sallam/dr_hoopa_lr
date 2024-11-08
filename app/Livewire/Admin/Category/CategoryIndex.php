<?php

namespace App\Livewire\Admin\Category;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use App\Livewire\Forms\CategoryForm;

class CategoryIndex extends Component
{
    use Toast;
    public string $title = "الكورسات";
    public string $logo = <<<'EOT'
     <svg class="w-12 h-12 "
                             viewBox="0 0 30 30" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.0379 19.5502C21.8754 19.0002 22.9754
                             19.6002 22.9754 20.6002V22.2127C22.9754 23.8002
                             21.7379 25.5002 20.2504 26.0002L16.2629 27.3252C15.5629 27.5627 14.4254 27.5627 13.7379 27.3252L9.75039 26.0002C8.25039 25.5002 7.02539 23.8002 7.02539 22.2127V20.5877C7.02539 19.6002
                             8.12539 19.0002 8.95039 19.5377L11.5254 21.2127C12.5129
                             21.8752 13.7629 22.2002 15.0129 22.2002C16.2629 22.2002 17.5129 21.8752 18.5004 21.2127L21.0379 19.5502Z" fill="currentColor"/>
                            <path d="M24.9754 8.07422L17.4879 3.16172C16.1379
                             2.27422 13.9129 2.27422 12.5629 3.16172L5.03789
                             8.07422C2.62539 9.63672 2.62539 13.1742 5.03789
                             14.7492L7.03789 16.0492L12.5629 19.6492C13.9129
                             20.5367 16.1379 20.5367 17.4879 19.6492L22.9754
                             16.0492L24.6879 14.9242V18.7492C24.6879 19.2617
                             25.1129 19.6867 25.6254 19.6867C26.1379 19.6867 26.5629 19.2617 26.5629 18.7492V12.5992C27.0629 10.9867 26.5504 9.11172 24.9754 8.07422Z" fill="currentColor"/>
                        </svg>
EOT;

    public array $headers;
    public array $sortBy;
    public string $successMessage = '';
    public bool $showArchived = false;
    public bool $showFilterDrawer = false;
    public bool $showAddModal = false;
    public CategoryForm $form;

    public function mount()
    {
        // $this->authorize('viewAny', User::class);
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'اسم القسم'],
        ];

        $this->sortBy = ['column' => 'id', 'direction' => 'asc', 'class' => 'text-red-500'];
        $this->successMessage = __('success');
        // $this->archivedMessage = __('archived');
    }



    public function render()
    {
        return view('livewire.admin.category.category-index')->layout('layouts.admin', [
            "title" => $this->title,
            "logo" => $this->logo,
        ]);
    }

    public function categories()
    {
        return Category::all();
    }

    public function save()
    {
        $this->form->store();
        $this->showAddModal = false;
        $this->success('تم إضافة القسم بنجاح');
    }
}
