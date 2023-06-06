<?php

namespace App\Http\Livewire;

use App\Models\Gender;
use App\Models\Pet;
use App\Models\Race;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PetRegister extends Component {
    public $name;
    public $username;
    public $race_id;
    public $race_list;
    public $gender_id;
    public $gender_list;
    public $showModal;

    public function mount() {
        $this->showModal = false;
    }

    public function register()
    {
        // Validar los datos del formulario
        $this->validate(
            [
                'name' => 'required|max:8|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
                'username' => 'required|max:10|unique:pets|regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ_-]+$/',
                'race_id' => 'required',
                'gender_id' => 'required'
            ],
            [
                'name.required' => 'Introduce un nombre.',
                'name.max' => 'El nombre no puede superar :max caracteres.',
                'name.regex' => 'El nombre no es válido.',
                'username.required' => 'Introduce un nombre de usuario.',
                'username.max' => 'El nombre de usuario no puede superar los :max caracteres.',
                'username.unique' => 'Este nombre de usuario ya está en uso.',
                'username.regex' => 'El nombre de usuario no puede contener espacios ni caracteres especiales.',
                'race_id.required' => 'Selecciona una raza.',
                'gender_id.required' => 'Selecciona un género'
            ]
        );

        // Crear un nuevo registro de usuario
        $pet = Pet::create([
            'name' => $this->name,
            'username' => $this->username,
            'biographie' => '',
            'profile_img' => 'default.png',
            'race_id' => $this->race_id,
            'gender_id' => $this->gender_id,
            'user_id' => auth()->user()->id
        ]);

        // Limpiar los campos del formulario
        $this->reset();

        session()->put('pet', $pet);

        return redirect()->to('/feed');
    }

    public function render() {
        $this->race_list = Race::all();
        $this->gender_list = Gender::all();
        return view('livewire.pet-register');
    }
}
