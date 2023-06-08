<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Pet;
use Livewire\Component;

class DiscoverComponent extends Component
{
    public $pets;

    public function render() {
        $this->pets = Pet::where('id', '!=', session('pet')->id)->get();
        return view('livewire.discover-component');
    }

    public function followPet ($petFollowerId, $petFollowedId) {
        $petFollower = Pet::find($petFollowerId);
        $petFollowed = Pet::find($petFollowedId);
        Follow::create(['pet_id' => $petFollower->id, 'pet_id_following' => $petFollowed->id]);
        $this->emit("refreshComponent");
    }

    public function unfollowPet ($petFollowerId, $petFollowedId) {
        $petFollower = Pet::find($petFollowerId);
        $petFollowed = Pet::find($petFollowedId);
        Follow::where('pet_id', $petFollower->id)->where('pet_id_following', $petFollowed->id)->delete();
        $this->emit("refreshComponent");
    }
}
