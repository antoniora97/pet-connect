<div class="relative flex flex-col gap-5 pb-3 overflow-hidden bg-sky-400/30">
    {{-- Header --}}
    <div class="relative flex items-center px-4 py-12 bg-slate-100" style="border-radius: 0 0 0 3em">
        <a class="absolute text-lg" href="{{ route('index') }}"><i class="flex fi fi-rr-angle-left"></i></a>
        <h1 class="flex-grow text-xl font-bold tracking-tighter text-center">Únete a PetConnect</h1>
    </div>

    {{-- Form --}}
    <div>
        <form wire:submit.prevent="register" class="flex flex-col gap-5 px-6 tracking-tighter">
            {{-- Person 1 name --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="name1" class="font-semibold">Nombre de la persona 1 *</label>
                <input id="name1" type="text" placeholder="Juan Carlos Aragón Becerra" wire:model="person1_name" class="text-black bg-transparent outline-none">
                @error('person1_name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Person 2 name --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="name2" class="font-semibold">Nombre de la persona 2</label>
                <input id="name2" type="text" placeholder="Antonio Martínez Ares" wire:model="person2_name" class="text-black bg-transparent outline-none">
                @error('person2_name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="email" class="font-semibold">Correo electrónico *</label>
                <input id="email" type="email" placeholder="ejemplo@gmail.com" wire:model="email" class="text-black bg-transparent outline-none">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password" class="font-semibold">Contraseña *</label>
                <input id="password" type="password" wire:model="password" placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" class="text-black bg-transparent outline-none">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Password confirmation --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password_confirmation" class="font-semibold">Confirmar contraseña *</label>
                <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" class="text-black bg-transparent outline-none">
                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <button type="submit" class="w-full font-semibold text-white">Registrarse</button>
            </div>
        </form>
    </div>
</div>
