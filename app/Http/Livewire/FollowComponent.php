<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Livewire\Component;

class FollowComponent extends Component
{
    
    public function isFollowed() {
        return $this->follows()->where('pet_id', auth()->id())->exists();
    }

    public function followPet (Pet $pet) {
        session('pet')->following()->attach($pet->id);
    }

    public function unfollowPet (Pet $pet) {
        session('pet')->following()->detach($pet->id);
    }

    public function render()
    {
        return view('livewire.follow-component');
    }
}
