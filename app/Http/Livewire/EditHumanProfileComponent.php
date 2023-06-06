<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class EditHumanProfileComponent extends Component
{
    public $user;
    public $name1;
    public $name2;
    public $email;
    public $password;
    public $password_confirmation;
    public $deleteConfirmationModal;

    public function mount ($userId) {
        $this->user = User::find($userId);
        $this->name1 = $this->user->person1_name;
        $this->name2 = $this->user->person2_name;
        $this->email = $this->user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->deleteConfirmationModal = false;
    }

    public function updateUser () {
        // Validar los datos del formulario
        $this->validate(
            [
                'name1' => 'required|min:1|max:15|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
                'name2' => 'max:15|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
                'email' => 'required|email|unique:users,email,' . $this->user->id,
                'password' => [Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
                'password_confirmation' => 'same:password'
            ],
            [
                'name1.required' => 'Introduce un nombre.',
                'name1.max' => 'El nombre no puede superar :max caracteres.',
                'name1.regex' => 'El nombre no es válido.',
                'name2.max' => 'El nombre no puede superar :max caracteres.',
                'name2.regex' => 'El nombre no es válido.',
                'email.required' => 'Introduce un correo electrónico.',
                'email.email' => 'Introduce un correo electrónico válido.',
                'email.unique' => 'Este correo electrónico ya está en uso.',
                'password.min' => 'La contraseña debe tener un mínimo de :min caracteres.',
                'password_confirmation.same' => 'Las contraseñas no coinciden.'
            ]
        );

        $this->user->person1_name = $this->name1;
        $this->user->person2_name = $this->name2;
        $this->user->email = $this->email;
        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }
        $this->user->save();

        return redirect()->to(route('profile.human', $this->user->id));
    }

    public function delete () {
        Auth::logout();
        $this->user->delete();
        return redirect()->to(route('index'));
    }

    public function toggleDeleteConfirmationModal () {
        $this->deleteConfirmationModal = $this->deleteConfirmationModal ? false : true;
    }

    public function render()
    {
        return view('livewire.edit-human-profile-component');
    }
}
