<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPetProfileComponent extends Component
{
    public $pet;
    public $name;
    public $username;
    public $biographie;

    public function mount ($petId) {
        $this->pet = Pet::find($petId);
        $this->name = $this->pet->name;
        $this->username = $this->pet->username;
        $this->biographie = $this->pet->biographie;
    }

    public function updatePet () {
        $this->validate([
            'name' => 'required|max:10|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
            'username' => 'required|max:10|regex:/^[a-zA-Z0-9_-]+$/|unique:pets,username,' . $this->pet->id,
            'biographie' => 'max:80'
        ], [
            'name.required' => 'Introduce un nombre.',
            'name.max' => 'El nombre no puede superar :max caracteres.',
            'username.required' => 'Introduce un nombre.',
            'username.max' => 'El nombre de usuario no puede superar :max caracteres.',
            'username.regex' => 'El nombre de usuario no puede contener espacios, tildes ni caracteres especiales.',
            'username.unique' => 'Este nombre de usuario ya está en uso.'
        ]);

        $this->pet->name = $this->name;
        $this->pet->username = $this->username;
        $this->pet->biographie = $this->biographie;
        $this->pet->save();
        return redirect()->to(route('profile.pet', $this->pet->id));
    }

    public function render()
    {
        return view('livewire.edit-pet-profile-component');
    }
}
