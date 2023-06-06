<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class PasswordForgot extends Component
{
    public $email;
    public $successMessage;
    public $showModal;

    public function mount () {
        $this->showModal = false;
    }

    public function sendPasswordResetLink () {
        $this->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Introduce tu correo electrónico.',
                'email.email' => 'Introduce un correo electrónico válido.'
            ]
        );

        $response = Password::broker()->sendResetLink(['email' => $this->email]);
        if ($response == Password::RESET_LINK_SENT) {
            $this->reset();
            $this->successMessage = 'Se ha enviado un mensaje a tu correo electrónico';
            $this->showModal = true;
            return;
        }

        $this->successMessage = '';

        if ($response === Password::INVALID_USER) {
            $this->addError('email', 'No se encontró ningún usuario con esta dirección de correo electrónico.');
        } elseif ($response === Password::RESET_THROTTLED) {
            $this->addError('email', 'Por favor, espere antes de intentarlo nuevamente.');
        } else {
            $this->addError('email', 'Ha ocurrido un error al enviar el enlace de restablecimiento.');
        }

        $this->addError('email', trans($response));
    }

    public function render() {
        return view('livewire.password-forgot');
    }
}
