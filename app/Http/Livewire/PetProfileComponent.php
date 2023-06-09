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
    public $confirmDeleteModal;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($petId) {
        $this->pet = Pet::find($petId);
        $this->showProfileImgLabel = true;
        $this->showFollowers = false;
        $this->showFollowing = false;
        $this->confirmDeleteModal = false;
    }

    public function openFollowers () {
        $this->showFollowers = true;
        $this->confirmDeleteModal = false;
    }

    public function closeFollowers () {
        $this->showFollowers = false;
        $this->confirmDeleteModal = false;
    }

    public function openFollowing () {
        $this->showFollowing = true;
        $this->confirmDeleteModal = false;
    }

    public function closeFollowing () {
        $this->showFollowing = false;
        $this->confirmDeleteModal = false;
    }

    public function followPet ($petFollowerId, $petFollowedId) {
        $petFollower = Pet::find($petFollowerId);
        $petFollowed = Pet::find($petFollowedId);
        Follow::create(['pet_id' => $petFollower->id, 'pet_id_following' => $petFollowed->id]);
        $this->emit("refreshComponent");
        $this->confirmDeleteModal = false;
    }

    public function unfollowPet ($petFollowerId, $petFollowedId) {
        $petFollower = Pet::find($petFollowerId);
        $petFollowed = Pet::find($petFollowedId);
        Follow::where('pet_id', $petFollower->id)->where('pet_id_following', $petFollowed->id)->delete();
        $this->emit("refreshComponent");
        $this->confirmDeleteModal = false;
    }

    public function setProfileImage () {
        if ($this->profile_image != null) {
            $this->pet->profile_img = basename($this->profile_image->store('public/pet-profile-images/'));
            $this->pet->save();
        }
        $this->showProfileImgLabel = true;
        $this->confirmDeleteModal = false;
    }

    public function hiddenProfileImgLabel () {
        $this->showProfileImgLabel = false;
        $this->confirmDeleteModal = false;
    }

    public function redirectToPerson () {
        return redirect()->to(route('profile.human', $this->pet->user->id));
    }

    public function openConfirmDelete() {
        $this->confirmDeleteModal = true;
    }

    public function closeConfirmDelete () {
        $this->confirmDeleteModal = false;
    }

    public function deletePet () {
        $pet = $this->pet;
        $index = $this->pet->user->pets->search(function ($item) use ($pet) {
            return $item->id !== $pet->id;
        });
        session()->put('pet', $this->pet->user->pets->get($index));
        $this->pet->delete();
        return redirect()->to(route('profile.human', $this->pet->user_id));
    }

    public function render() {
        $this->following = $this->pet->following;
        $this->followers = $this->pet->followers;
        return view('livewire.pet-profile-component');
    }
}
