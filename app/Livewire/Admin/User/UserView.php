<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Livewire\Component;

class UserView extends Component
{

    use Toast;
    use WithPagination;

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



    public $user;
    public $nested= false;
    public array $headers;
    public array $sortBy= ['column' => 'id', 'direction' => 'asc'];
    public $selectedTab = 'courses';
    public $selectedTabContent = [];

    public $oldPassword = '';
    public $newPassword = '';
    public $confirmPassword = '';
    public bool $showChangePasswordModal = false;

    public function mount($id, $nested=false)
    {
        $this->user = $this->getUser($id);
        $this->nested = $nested;
        $this->setSelectedTab($this->selectedTab);

    }



    public function render()
    {
        return view('livewire.admin.user.user-view')->layout('layouts.admin', ['title' => $this->title, 'logo' => $this->logo]);
    }

    public function getUser($id)
    {
        return User::with([
            'enrollments', 'orders', 'cart'
        ])->findOrFail($id);
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

  public function setSelectedTab(string $tab): void
    {
        $this->selectedTab = $tab;
        switch ($tab) {
            case 'courses':
                $this->selectedTabContent = $this->user->enrollments()->with(['course.instructor'])->get();
                break;
            case 'books':
                break;
            case 'reviews':
                break;
            case 'orders':
                $this->selectedTabContent = $this->getEnrolledCourses();
                $this->headers = [
                    ['key' => 'id', 'label' => '#'],
                    ['key' => 'created_at', 'label' => 'تاريخ الطلب'],
                    ['key' => 'total_price', 'label' => 'السعر'],
                    ['key' => 'discount', 'label' => 'الخصم'],
                    ['key' => 'net_price', 'label' => 'السعر النهائي'],
                    ['key' => 'payment_method', 'label' => 'طريقة الدفع'],
                    ['key' => 'payment_status', 'label' => 'حالة الدفع'],
                    ['key' => 'currency', 'label' => 'العملة'],
                    ['key' => 'status', 'label' => 'حالة الطلب'],
                    ['key' => 'actions', 'label' => 'الإجراءات', 'sortable' => false],
                ];
                $this->sortBy = ['column' => 'id', 'direction' => 'asc', 'class' => 'text-red-500'];
                break;
            case 'cart':
                $this->selectedTabContent = $this->user->cart;
                break;
            default;
                $this->selectedTabContent = $this->user->enrollments;
        }

//        dd($this->selectedTabContent);
    }

    function getOrders()
    {
        return $this->user->orders()->orderBy(...array_values($this->sortBy))->get();
    }

    function getEnrolledCourses()
    {
        return $this->user->enrollments()->with(['course.instructor'])->get();
    }

    public $showingOrderDetails = false;
    public $selectedOrder = null;

    public function showOrderDetails($orderId)
    {
        $this->selectedOrder = \App\Models\Order::with(['items.course'])->find($orderId);
        $this->showingOrderDetails = true;
    }

    public function printInvoice($orderId) 
    {
        // TODO: Implement invoice printing
        $this->info('جاري تطوير هذه الميزة');
    }


    #[On('removeFromCart')]
    public function removeFromCart($id)
    {
        $cartItem = \App\Models\Cart::find($id);
        $cartItem->delete();
        $this->selectedTabContent = $this->user->cart;
    }

    #[On('show-change-password-modal')]
    public function showChangePasswordModalF($userId)
    {
        $this->selectedUserId = $userId;
        $this->showChangePasswordModal = true;
    }

    public function changePassword()
    {
        $this->authorize('update', $this->user);
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => [
                'required',
                'min:8',
                'different:oldPassword',
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
        if (!Hash::check($this->oldPassword, $user->password)) {
            $this->addError('oldPassword', 'كلمة المرور القديمة غير صحيحة');
            return;
        }

        // Update password
        $user->update([
            'password' => Hash::make($this->newPassword)
        ]);

        $this->reset(['selectedUserId', 'oldPassword', 'newPassword', 'confirmPassword']);
        $this->showChangePasswordModal = false;
        $this->success('تم تغيير كلمة المرور بنجاح');
    }


}
