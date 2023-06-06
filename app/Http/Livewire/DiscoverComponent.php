<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Livewire\Component;

class DiscoverComponent extends Component
{
    public $pets;

    public function render()
    {
        $this->pets = Pet::where('id', '!=', session('pet')->id)->get();
        return view('livewire.discover-component');
    }
}
