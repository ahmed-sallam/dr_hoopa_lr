<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class UserForm extends Form
{
    use WithFileUploads;

    public ?User $user = null;

    public ?string $first_name = '';
    public ?string $middle_name = '';
    public ?string $last_name = '';
    public ?string $email = '';
    public ?string $phone = '';
    public ?string $guardian_phone = '';
    public ?string $address = '';
    public ?string $city = '';
    public ?string $state = '';
    public ?string $address_description = '';
    public ?string $gender = '';
    public ?string $avatar = '';
    public ?string $password = '';
    public int $role_id = 0;

    public function rules()
    {
        return  [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($this->user?->id)],
            'guardian_phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address_description' => 'nullable|string',
            'gender' => 'required|string|in:male,female',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => $this->user ? 'nullable|string|min:8' : 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id'
        ];
    }

    public function setUserData($user)
    {
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->guardian_phone = $user->guardian_phone;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->address_description = $user->address_description;
        $this->gender = $user->gender;
        $this->avatar = $user->avatar;
        $this->role_id = $user->role_id;
    }
    public function store()
    {
        $this->validate();
        if ($this->avatar && !is_string($this->avatar)) {
            $this->avatar = $this->avatar->store('avatars', 'public');
        }
        $user = User::create(
            [
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'guardian_phone' => $this->guardian_phone,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'address_description' => $this->address_description,
                'gender' => $this->gender,
                'avatar' => $this->avatar,
                'role_id' => $this->role_id,
                'password' =>  bcrypt($this->password)
            ]
        );
    }

    public function update()
    {
        if (!$this->user) {
            throw new \Exception("User not set for update");
        }

        $rules = [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($this->user?->id)],
            'guardian_phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address_description' => 'nullable|string',
            'gender' => 'required|string|in:male,female',
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => $this->user ? 'nullable|string|min:8' : 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id'
        ];

        $this->validate($rules);
        if ($this->avatar && !is_string($this->avatar)) {
            $this->avatar = $this->avatar->store('avatars', 'public');
        } else {
            $this->avatar = $this->user->avatar;
        }

        $this->user->update(
            [
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'guardian_phone' => $this->guardian_phone,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'address_description' => $this->address_description,
                'gender' => $this->gender,
                'avatar' => $this->avatar,
                'role_id' => $this->role_id,
            ]
        );
    }
}
