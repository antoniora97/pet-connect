<div class="relative flex flex-col h-screen gap-5 pb-3 overflow-hidden bg-sky-400/30">
    {{-- Header --}}
    <div class="relative flex items-center px-4 py-12 bg-slate-100" style="border-radius: 0 0 0 3em">
        {{-- <a class="absolute text-lg" href="{{ route('index') }}"><i class="flex fi fi-rr-angle-left"></i></a> --}}
        <h1 class="flex-grow text-xl font-bold tracking-tighter text-center">Añade a tu mascota</h1>
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="register" class="flex flex-col gap-5 px-6 tracking-tighter">
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="name" class="font-semibold">Nombre *</label>
            <input id="name" type="text" placeholder="Timón" wire:model="name" class="text-black bg-transparent outline-none">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="username" class="font-semibold">Nombre de usuario *</label>
            <input id="username" type="text" placeholder="timonxulo" wire:model="username" class="text-black bg-transparent outline-none">
            @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
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
            <select id="gender" wire:model="gender_id" class="font-semibold text-black bg-transparent outline-none">
                <option>Seleccionar género *</option>
                @foreach ($gender_list as $gender)
                    <option value="{{ $gender['id'] }}">{{ $gender['name'] }}</option>
                @endforeach
            </select>
            @error('gender_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <button type="submit" class="w-full font-semibold text-white">Registrarse</button>
        </div>
    </form>
</div>
