<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PetProfileComponent extends Component
{
    use WithFileUploads;

    public $pet;
    public $followers;
    public $following;
    public $showProfileImgLabel;
    public $profile_image;
    public $showFollowers;
    public $showFollowing;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($petId) {
        $this->pet = Pet::find($petId);
        $this->showProfileImgLabel = true;
        $this->showFollowers = false;
        $this->showFollowing = false;
    }

    public function openFollowers () {
        $this->showFollowers = true;
    }

    public function closeFollowers () {
        $this->showFollowers = false;
    }

    public function openFollowing () {
        $this->showFollowing = true;
    }

    public function closeFollowing () {
        $this->showFollowing = false;
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

    public function reverseUnfollowPet($petId) {
        $pet = Pet::find($petId);
        Follow::where('pet_id', $this->pet->id)->where('pet_id_following', $pet->id)->delete();
        $this->emit("refreshComponent");
    }

    public function setProfileImage () {
        if ($this->profile_image != null) {
            $this->pet->profile_img = basename($this->profile_image->store('public/pet-profile-images/'));
            $this->pet->save();
        }
        $this->showProfileImgLabel = true;
    }

    public function hiddenProfileImgLabel () {
        $this->showProfileImgLabel = false;
    }

    public function redirectToPerson () {
        return redirect()->to(route('profile.human', $this->pet->user->id));
    }

    public function render()
    {
        $this->following = $this->pet->following;
        $this->followers = $this->pet->followers;
        return view('livewire.pet-profile-component');
    }
}
