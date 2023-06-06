<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPetProfileComponent extends Component
{
    use WithFileUploads;

    public $pet;
    public $profile_img;
    public $name;
    public $username;
    public $biographie;

    public function mount ($petId) {
        $this->pet = Pet::find($petId);
        $this->name = $this->pet->name;
        $this->username = $this->pet->username;
    }

    public function edit () {
        $this->validate([
            'name' => 'required|min:1|max:12',
            'username' => 'required|min:1|max:10|unique:pets|regex:/^[a-zA-Z0-9_-]+$/',
            'biographie' => 'max:15'
        ], [
            'name.min' => 'La longitud mínima del nombre es de :min caracter.',
            'name.max' => 'La longitud máxima del nombre es de :max caracteres.',
            'username.min' => 'La longitud mínima del nombre de usuario es de :min caracter.',
            'username.max' => 'La longitud máxima del nombre de usuario es de :max caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'username.regex' => 'El nombre de usuario no puede contener espacios.',
            'biographie.max' => 'La biografía no puede contener más de :max caracteres.'
        ]);
    }

    public function render()
    {
        return view('livewire.edit-pet-profile-component');
    }
}
