<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Pet;
use Livewire\Component;

class FollowComponent extends Component {

    public function isFollowed() {
        return $this->follows()->where('pet_id', session('pet')->id)->exists();
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
        return view('livewire.follow-component');
    }
}
