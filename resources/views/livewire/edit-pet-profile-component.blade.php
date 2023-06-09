<div class="flex flex-col pb-4 md:w-4/5 lg:w-2/4 lg:m-auto">
    {{-- Header --}}
    <div class="relative flex items-center justify-center w-full py-2 lg:m-auto">
        <a href={{route('profile.pet', $pet->id)}} class="absolute text-xl right-2 lg:right-0"><i class="flex fi fi-rr-cross"></i></a>
        <h1 class="font-semibold">Editar perfil de humano</h1>
    </div>

    <div class="h-48 bg-sky-200/40 flex items-center justify-center">
        <div class="flex items-center justify-center w-32 h-32 m-auto rounded-full">
            <img src="{{ asset('storage/pet-profile-images/' . $pet->profile_img)}}" class="w-full h-full rounded-full" alt="">
        </div>
    </div>

    {{-- Formulario de edición de perfil --}}
    <form wire:submit.prevent="updatePet" class="flex flex-col w-full gap-2 lg:m-auto px-3 py-1">
        @csrf

        {{-- Name --}}
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="name" class="font-semibold">Nombre</label>
            <input type="text" id="name" name="name" wire:model="name" class="text-black bg-transparent outline-none">
            @error('name') <p class="text-red-500">{{$message}}</p> @enderror
        </div>

        {{-- Username --}}
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="username" class="font-semibold">Username</label>
            <input type="text" id="username" name="username" wire:model="username" class="text-black bg-transparent outline-none">
            @error('username') <p class="text-red-500">{{$message}}</p> @enderror
        </div>

        {{-- Biographie --}}
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="biographie" class="font-semibold">Biografía</label>
            <textarea rows="3" wire:model='biographie' id="biographie" name="biographie" maxlength="80" class="text-black resize-none bg-transparent outline-none h-fit"></textarea>
            @error('biographie') <p class="text-red-500">{{$message}}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="p-3 text-white bg-gradient-to-r from-sky-300/70 to-purple-400/70 hover:from-purple-400/70 hover:to-sky-300/70 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <button type="submit" class="w-full font-semibold text-white">Guardar cambios</button>
        </div>
    </form>
</div>
