<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Mary\Traits\Toast;
use Livewire\Component;

class UserView extends Component
{

    use Toast;

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
    public function mount($id, $nested=false)
    {
        $this->user = $this->getUser($id);
        $this->nested = $nested;
    }

    public $selectedTab = 'courses';
    public $selectedTabContent = [];

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
                $this->selectedTabContent = $this->user->enrollments;
                break;
            case 'books':
                break;
            case 'reviews':
                break;
            case 'orders':
                $this->selectedTabContent = $this->user->orders;
                break;
            case 'cart':
                $this->selectedTabContent = $this->user->cart;
                break;
            default;
                $this->selectedTabContent = $this->user->enrollments;
        }

//        dd($this->selectedTabContent);
    }



    #[On('removeFromCart')]
    public function removeFromCart($id)
    {
        $cartItem = \App\Models\Cart::find($id);
        $cartItem->delete();
        $this->selectedTabContent = $this->user->cart;
    }
}
