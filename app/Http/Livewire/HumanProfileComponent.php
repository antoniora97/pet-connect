<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class HumanProfileComponent extends Component {

    public $user;
    public $pets;
    public $posts;
    public $isOpenListOfPets;
    public $biographie;
    public $bg_image;
    public $profile_image;
    public $showPosts;
    public $showBgImgLabel;
    public $showProfileImgLabel;

    use WithFileUploads;

    public function mount ($userId) {
        $this->user = User::find($userId);
        $this->isOpenListOfPets = false;
        $this->pets = $this->user->pets;
        $this->biographie = $this->user->biographie;
        $this->showPosts = false;
        $this->showBgImgLabel = true;
        $this->showProfileImgLabel = true;
    }

    public function changePet (Pet $pet) {
        session()->put('pet', $pet);
        return redirect()->intended(route('profile.pet', $pet->id));
    }

    public function toggleListOfPets () {
        $this->isOpenListOfPets = $this->isOpenListOfPets ? false : true;
    }

    public function logout() {
        Auth::logout();
        return redirect()->to(route('index'));
    }

    public function setBiographie () {
        $this->user->biographie = $this->biographie;
        $this->user->save();
    }

    public function setBgImage () {
        if ($this->bg_image != null) {
            $this->user->bg_image = basename($this->bg_image->store('public/human-bg-images/'));
            $this->user->save();
        }
        $this->showBgImgLabel = true;
    }

    public function hiddenBgImgLabel () {
        $this->showBgImgLabel = false;
        $this->showProfileImgLabel = true;
    }

    public function setProfileImage () {
        if ($this->profile_image != null) {
            $this->user->profile_img = basename($this->profile_image->store('public/human-profile-images/'));
            $this->user->save();
        }
        $this->showProfileImgLabel = true;
    }

    public function hiddenProfileImgLabel () {
        $this->showProfileImgLabel = false;
        $this->showBgImgLabel = true;
    }

    public function render() {
        $this->posts = [];
        $this->showPosts = false;
        foreach ($this->pets as $pet) {
            if (count($pet->posts)>0) {
                $this->showPosts = true;
            }
            $this->posts[] = $pet->posts;
        }
        return view('livewire.human-profile-component');
    }
}

