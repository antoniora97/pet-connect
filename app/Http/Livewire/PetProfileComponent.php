<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PetProfileComponent extends Component
{
    public $pet;
    public $followers;
    public $following;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($petId) {
        $this->pet = Pet::find($petId);
    }

    public function followPet ($petId) {
        $pet = Pet::find($petId);
        Follow::create(['pet_id' => $pet->id, 'pet_id_following' => $this->pet->id]);
        $this->emit("refreshComponent");
    }

    public function unfollowPet ($petId) {
        $pet = Pet::find($petId);
        Follow::where('pet_id', $pet->id)->where('pet_id_following', $this->pet->id)->delete();
        $this->emit("refreshComponent");
    }

    public function render()
    {
        $this->following = $this->pet->following;
        $this->followers = $this->pet->followers;
        return view('livewire.pet-profile-component');
    }
}
