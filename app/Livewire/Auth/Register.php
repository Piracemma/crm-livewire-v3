<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate(['required', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'max:255', 'email', 'confirmed'])]
    public ?string $email = null;

    public ?string $email_confirmation = null;

    #[Validate(['required'])]
    public ?string $password = null;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function submit()
    {
        $this->validate();

        User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

    }
}
