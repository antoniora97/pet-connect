<div class="p-4">

    <div class="relative flex justify-center">
        <h1 class="text-2xl font-bold text-center">Editar perfil</h1>
        <p class="absolute bottom-0 w-40 h-2 rounded-full -z-10 bg-sky-200"></p>
    </div>

    {{-- Formulario de edición de perfil --}}
    <form wire:submit.prevent="register" class="max-w-sm mx-auto">
        @csrf

        {{-- Profile image --}}
        <div class="relative mb-4">
            <div class="flex items-center justify-center w-32 h-32 m-auto mt-3">
                <img src="{{ asset('storage/profile-images/' . $pet->profile_img)}}" class="w-full h-full" alt="">
                <label for="image" class="absolute flex items-center justify-center w-32 h-32 text-xl font-bold"><i class="fi fi-sr-upload"></i></label>
            </div>
            <input type="file" id="image" wire:model="image" class="hidden">
        </div>

        {{-- Name --}}
        <div class="mb-4">
            <label for="name" class="block">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ $pet->name }}" wire:model="name" class="@error('name') bg-red-200 @enderror w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            @error('name') <p class="text-red-500">{{$message}}</p> @enderror
        </div>

        {{-- Username --}}
        <div class="mb-4">
            <label for="username" class="block">Username:</label>
            <input type="text" id="username" name="username" wire:model="username" value="{{ $pet->username }}" class="@error('username') bg-red-200 @enderror w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            @error('username') <p class="text-red-500">{{$message}}</p> @enderror
        </div>

        {{-- Biographie --}}
        <div class="mb-4">
            <label for="biographie" class="block">Biografía:</label>
            <textarea id="biographie" name="biographie" class="@error('biographie') bg-red-200 @enderror w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">{{ $pet->biographie }}</textarea>
        </div>

        {{-- Submit --}}
        <button wire:click="edit" type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Guardar cambios</button>
    </form>
</div>
