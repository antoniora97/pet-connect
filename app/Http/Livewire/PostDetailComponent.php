<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class PostDetailComponent extends Component
{
    public $previous_route;
    public function mount () {
        // $this->previous_route = request()->header('referer');
        $this->previous_route = URL::previous();
    }

    public function render()
    {
        $this->previous_route = $this->previous_route;
        return view('livewire.post-detail-component');
    }
}
