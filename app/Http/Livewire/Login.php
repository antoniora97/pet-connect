<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $result_message;

    public function login () {
        $this->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ],
            [
                'email.required' => 'Introduce tu correo electrónico.',
                'email' => 'Introduce un correo electrónico válido.',
                'password.required' => 'Introduce tu contraseña.',
                'password.min' => 'La contraseña debe tener un mínimo de :min caracteres.'
            ]
        );

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            if (auth()->user()->id == 99) {
                return redirect()->to(route('admin.dashboard'));
            }
            // Inicio de sesión exitoso, redirigir a la página deseada
            session()->put('pet', auth()->user()->pets[0]);
            return redirect(route('profile.human', auth()->user()->id));
        } else {
            // Credenciales de inicio de sesión incorrectas, muestra un mensaje de error
            $this->result_message = 'Credenciales de inicio de sesión incorrectas.';
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
