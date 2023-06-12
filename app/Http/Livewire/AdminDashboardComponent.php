<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public $user;
    public $events;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $participants;

    public function mount () {
        $this->user = Auth::user();
        $this->events = Event::all();
    }

    public function deleteEvent ($eventId) {
        $event = Event::find($eventId);
        $event->delete();
        $this->emit('refreshComponent');
    }

    public function getParticipants ($eventId) {
        $event = Event::find($eventId);
        $raceId = $event->race_id;
        $participants = User::whereHas('pets', function ($query) use ($raceId) {
            $query->where('race_id', $raceId);
        })->with('pets')->get();
        return $participants;
    }

    public function render()
    {
        return view('livewire.admin-dashboard-component');
    }
}
