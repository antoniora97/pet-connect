<div class="flex flex-col pb-4 md:w-4/5 lg:w-2/4 lg:m-auto">
    {{-- Header --}}
    <div class="relative flex items-center justify-center w-full py-2 lg:m-auto">
        <a href={{route('profile.human', $user->id)}} class="absolute text-xl right-2 lg:right-0"><i class="flex fi fi-rr-cross"></i></a>
        <h1 class="font-semibold">Editar perfil de humano</h1>
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="updateUser" class="flex flex-col w-full gap-5 lg:m-auto">
        <div class="w-full overflow-hidden">
            <div class="relative flex h-72 lg:m-auto lg:flex lg:justify-center">
                <div class="absolute z-30 w-full h-full bg-sky-700/10 backdrop-blur-lg"></div>
                <img src="{{asset('storage/human-profile-images/' . $user->profile_img)}}" alt="" class="object-cover w-full h-72">
                <div class="absolute z-30 flex flex-col items-center justify-center w-full" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <img src="{{asset('storage/human-profile-images/' . $user->profile_img)}}" alt="" class="object-cover w-32 h-32 mb-4 rounded-full">
                    <div class="z-30 flex flex-col p-1 mb-2 border-b-2 border-sky-600 bottom-16">
                        @error('name1') <span class="text-red-600">{{ $message }}</span> @enderror
                        <input wire:model="name1" type="text" id="name1" class="font-semibold text-white bg-transparent outline-none focus:text-black focus:bg-sky-300/30">
                    </div>
                    <div class="z-30 flex flex-col p-1 border-b-2 border-sky-600 bottom-3">
                        @error('name2') <span class="text-red-600">{{ $message }}</span> @enderror
                        <input wire:model="name2" type="text" id="name2" class="font-semibold text-white bg-transparent outline-none focus:text-black focus:bg-sky-300/30">
                    </div>
                </div>
            </div>
        </div>

        {{-- Other information --}}
        <div class="flex flex-col justify-center gap-4 px-2">
            {{-- Email --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="email" class="font-semibold">Correo electrónico</label>
                <input id="email" type="email" placeholder="ejemplo@gmail.com" wire:model="email" class="text-black bg-transparent outline-none">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password" class="font-semibold">Contraseña</label>
                <input id="password" type="password" wire:model="password" placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" class="text-black bg-transparent outline-none">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Password confirmation --}}
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password_confirmation" class="font-semibold">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" class="text-black bg-transparent outline-none">
                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="p-3 text-white bg-gradient-to-r from-sky-300/70 to-purple-400/70 hover:from-purple-400/70 hover:to-sky-300/70 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <button type="submit" class="w-full font-semibold text-white">Guardar cambios</button>
            </div>
        </div>
    </form>

    <div class="absolute z-30 rounded-full right-2 top-12 bg-red-600/60">
        <button wire:click="toggleDeleteConfirmationModal" class="p-2 text-xl text-white"><i class="flex fi fi-rr-trash"></i></button>
    </div>

    {{-- Confirm delete modal --}}
    @if ($deleteConfirmationModal)
    <div class="absolute z-50 flex flex-col justify-center w-full h-screen gap-2 p-12 bg-white" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <p class="font-semibold">Tu cuenta se eliminará permanentemente. ¿Estás de acuerdo?</p>
        <div class="flex items-center justify-center gap-2 font-semibold">
            <button class="px-2 py-1 rounded-full bg-red-400/60" wire:click="delete">Confirmar</button>
            <button class="px-2 py-1 rounded-full bg-slate-300" wire:click="toggleDeleteConfirmationModal">Cancelar</button>
        </div>
    </div>
    @endif
</div>
