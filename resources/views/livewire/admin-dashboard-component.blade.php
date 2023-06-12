<div class="flex flex-col items-center justify-center">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <h1 class="p-4 text-2xl font-bold text-center">Bienvenido, {{ $user->person1_name }}</h1>

    <a href="{{route('event.create')}}" class="p-2 rounded-lg w-fit bg-gradient-to-r from-sky-400/30 to-purple-400/30">Crear eventos</a>

    <div class="w-full px-2 mt-5">
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Raza</th>
                    <th>Participantes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{$event->date}}</td>
                    <td>{{$event->time}}</td>
                    <td>{{$event->race->name}}</td>

                    <?php $participants = App\Http\Livewire\AdminDashboardComponent::getParticipants($event->id); ?>
                    <td>
                        @foreach ($participants as $participant)
                            @foreach ($participant->pets as $pet)
                                @if ($pet->race_id == $event->race_id)
                                    {{$pet->name}}
                                @endif
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        <button wire:click='deleteEvent({{$event->id}})' class="px-2 py-1 bg-red-300 rounded-lg">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
