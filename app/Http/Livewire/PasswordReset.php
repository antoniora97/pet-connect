<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class PasswordReset extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $tokenExpiredMessage;

    public function mount($token) {
        $this->email = request()->query('email', '');
        $this->token = $token;

        // Check if the token is valid.
        if (!Password::tokenExists(User::where('email', $this->email)->first(), $token)) {
            $this->addError('token', trans('Este enlace ha expirado. Por favor, solicita otro enlace.'));
        }
    }

    public function resetPassword() {
        $this->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
            ],
            [
                'token.required' => 'El token de reestablecimiento no es correcto.',
                'email.required' => 'Introduce tu correo electrónico.',
                'email' => 'Introduce un correo electrónico válido.',
                'password.required' => 'Introduce una contraseña.',
                'password.min' => 'La contraseña debe tener un mínimo de :min caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password_confirmation.required' => 'Introduce la misma contraseña.',
                'password_confirmation.min' => 'Introduce la misma contraseña.',
                'password_confirmation.confirmed' => 'Las contraseñas no coinciden.'
            ]
        );

        $response = Password::broker()->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect(route('index'));
        }

        $this->addError('token', trans($response));
    }

    public function render()
    {
        return view('livewire.password-reset');
    }
}
