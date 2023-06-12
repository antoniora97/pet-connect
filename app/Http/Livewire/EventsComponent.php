<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Race;
use App\Models\User;
use App\Notifications\EventCreatedNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class EventsComponent extends Component
{

    public $title;
    public $description;
    public $date;
    public $time;
    public $race_id;
    public $race_list;

    public function mount () {
        $this->race_list = Race::all();
    }

    public function create () {
        $this->validate([
            'title' => 'required|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/|unique:events',
            'description' => 'required|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\\s]+$/',
            'date' => 'required|after:tomorrow',
            // 'time' => 'required|after:tomorrow',
            'race_id' => 'required'
        ], [
            'title.required' => 'Introduce un título.',
            'title.max' => 'El título no puede superar :max caracteres.',
            'title.regex' => 'El título solo puede contener letras y tildes.',
            'title.unique' => 'Ya existe un evento con ese nombre.',
            'description.required' => 'Introduce una descripción.',
            'description.max' => 'La descripción no puede superar :max caracteres.',
            'description.regex' => 'La descripción solo puede contener letras y tildes.',
            'date.required' => 'Introduce la fecha del evento.',
            'date.after' => 'La fecha debe ser posterior a mañana.',
            'time.required' => 'Introduce la hora del evento.',
            'time.after' => 'La hora debe ser posterior a mañana.',
            'race_id.required' => 'Introduce una raza.'
        ]);

        $event = Event::create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time,
            'race_id' => $this->race_id
        ]);

        $raceId = $this->race_id;
        $users = User::whereHas('pets', function ($query) use ($raceId) {
            $query->where('race_id', $raceId);
        })->with('pets')->get();

        foreach ($users as $user) {
            Notification::send($user, new EventCreatedNotification($event));
        }

        return redirect()->to(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.events-component');
    }
}
