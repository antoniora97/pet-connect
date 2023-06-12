<div class="py-5">
    <h1 class="text-3xl font-semibold text-center">Crea un evento</h1>
    <form wire:submit.prevent="create" class="flex flex-col justify-between w-4/5 gap-2 m-auto mt-5">
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="title" class="font-semibold text-black bg-transparent outline-none">Título</label>
            <input type="text" wire:model="title" id="title" placeholder="Mastines de la Zona Sur" class="text-black bg-transparent outline-none">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="description" class="font-semibold text-black bg-transparent outline-none">Descripción</label>
            <input type="text" wire:model="description" placeholder="Describe el evento" id="description" class="text-black bg-transparent outline-none">
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <select id="race" wire:model="race_id" class="font-semibold text-black bg-transparent outline-none">
                <option>Seleccionar raza *</option>
                @foreach ($race_list as $race)
                    <option value="{{ $race['id'] }}">{{ $race['name'] }}</option>
                @endforeach
            </select>
            @error('race_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="date" class="font-semibold">Fecha</label>
            <input id="date" type="date" wire:model="date" class="text-black bg-transparent outline-none">
            @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="time" class="font-semibold">Hora</label>
            <input id="time" type="time" wire:model="time" class="text-black bg-transparent outline-none">
            @error('time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <button type="submit" class="w-full font-semibold text-white">Crear</button>
        </div>
    </form>
</div>
