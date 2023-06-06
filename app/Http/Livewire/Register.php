<?php

namespace App\Http\Livewire\AuthComponents;

use App\Models\Race;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $username;
    public $race_id;
    public $email;
    public $password;
    public $password_confirmation;
    public $race_list;
    public $showModal;

    public function mount() {
        $this->race_list = Race::all();
        $this->showModal = false;
    }

    public function register()
    {
        // Validar los datos del formulario
        $this->validate(
            [
                'name' => 'required',
                'username' => 'required|unique:users|no_spaces',
                'race_id' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
            ],
            [
                'name.required' => 'Introduce un nombre.',
                'username.required' => 'Introduce un nombre de usuario.',
                'username.unique' => 'Este nombre de usuario ya está en uso.',
                'username.no_spaces' => 'El nombre de usuario no puede contener espacios.',
                'race_id.required' => 'Selecciona una raza.',
                'email.required' => 'Introduce un correo electrónico.',
                'email.email' => 'Introduce un correo electrónico válido.',
                'email.unique' => 'Este correo electrónico ya está en uso.',
                'password.required' => 'Introduce una contraseña.',
                'password.min' => 'La contraseña debe tener un mínimo de :min caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password_confirmation.required' => 'Introduce la misma contraseña.',
                'password_confirmation.min' => 'Introduce la misma contraseña.',
                'password_confirmation.confirmed' => 'Las contraseñas no coinciden.'
            ]
        );

        // Crear un nuevo registro de usuario
        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'race_id' => $this->race_id,
            'email' => $this->email,
            'profile_img_path' => 'default.png',
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user, true);

        // Limpiar los campos del formulario
        $this->reset();

        // Mostrar el modal después del registro exitoso
        $this->showModal = true;
    }

    public function redirectToFeed()
    {
        // Realizar cualquier lógica necesaria antes de la redirección
        $this->showModal = false;
        return redirect()->to('/feed');
    }


    public function render()
    {
        $this->race_list = Race::all();
        return view('livewire.register');
    }
}
