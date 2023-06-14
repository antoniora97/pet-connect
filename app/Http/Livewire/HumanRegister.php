<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class HumanRegister extends Component {
    public $person1_name;
    public $person2_name;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $showModal;

    public function mount() {
        $this->person2_name = '';
        $this->showModal = false;
    }

    public function register()
    {
        // Validar los datos del formulario
        $this->validate(
            [
                'person1_name' => 'required|max:15|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
                'person2_name' => 'max:15|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
                'email' => 'required|email|unique:users',
                'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
                'password_confirmation' => 'same:password'
            ],
            [
                'person1_name.required' => 'Introduce un nombre.',
                'person1_name.max' => 'El nombre no puede superar :max caracteres.',
                'person1_name.regex' => 'El nombre no es válido.',
                'person2_name.max' => 'El nombre no puede superar :max caracteres.',
                'person2_name.regex' => 'El nombre no es válido.',
                'email.required' => 'Introduce un correo electrónico.',
                'email.email' => 'Introduce un correo electrónico válido.',
                'email.unique' => 'Este correo electrónico ya está en uso.',
                'password.required' => 'Introduce una contraseña.',
                'password.min' => 'La contraseña debe tener un mínimo de :min caracteres.',
                'password_confirmation.same' => 'Las contraseñas no coinciden.'
            ]
        );

        // Crear un nuevo registro de usuario
        $user = User::create([
            'person1_name' => $this->person1_name,
            'person2_name' => $this->person2_name,
            'email' => $this->email,
            'profile_img' => 'default.png',
            'bg_image' => 'default.jpg',
            'password' => Hash::make($this->password)
        ])->assignRole('user');

        Auth::login($user, true);

        // Limpiar los campos del formulario
        $this->reset();

        return redirect()->to('/pet-register');
    }

    public function render() {
        return view('livewire.human-register');
    }
}
