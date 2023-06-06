<div class="relative flex flex-col h-screen gap-5 overflow-hidden bg-sky-400/30">
    {{-- Estilos para ocultar la barra de desplazamiento en navegadores compatibles --}}
    <style>
        .scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

    {{-- Header --}}
    <div class="relative flex items-center px-4 py-12 bg-slate-100" style="border-radius: 0 0 0 3em">
        <a class="absolute text-lg" href="{{ route('index') }}"><i class="flex fi fi-rr-angle-left"></i></a>
        <h1 class="flex-grow text-xl font-bold tracking-tighter text-center">Recuperar contraseña</h1>
    </div>

    {{-- Form --}}
    <div>
        <form wire:submit.prevent="resetPassword" class="flex flex-col gap-5 px-6 tracking-tighter">
            <input wire:model="token" type="hidden">

            <div class="flex flex-col p-3 overflow-y-hidden bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <p class="font-bold">Correo electrónico:</p>
                <p class="overflow-scroll scrollbar"> {{$email}}</p>
                @error('token')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="@error('token') ? hidden @enderror flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password" class="font-semibold">Nueva contraseña</label>
                <input placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" type="password" id="password" wire:model="password" class="bg-transparent outline-none ">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="@error('token') ? hidden @enderror flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="password_confirmation" class="font-semibold">Confirmar contraseña</label>
                <input placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" type="password" id="password_confirmation" wire:model="password_confirmation" class="text-black bg-transparent outline-none">
                @error('password_confirmation')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="@error('token') ? hidden @enderror p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <button type="submit" class="w-full font-semibold text-white">Recuperar contraseña</button>
            </div>
        </form>
    </div>
</div>
