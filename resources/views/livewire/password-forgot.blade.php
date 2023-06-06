<div class="relative flex flex-col h-screen gap-5 bg-sky-400/30">

    <div class="relative flex items-center px-4 py-12 bg-slate-100" style="border-radius: 0 0 0 3em">
        <a class="absolute text-lg" href="{{ route('index') }}"><i class="flex fi fi-rr-angle-left"></i></a>
        <h1 class="flex-grow text-xl font-bold tracking-tighter text-center">Recuperar contraseña</h1>
    </div>

    <div>
        <form wire:submit.prevent="sendPasswordResetLink" class="flex flex-col gap-5 px-6 tracking-tighter">
            <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <label for="email" class="font-semibold">Correo electrónico</label>
                <input placeholder="ejemplo@gmail.com" type="text" id="email" wire:model="email" class="text-black bg-transparent outline-none">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
                <button type="submit" class="w-full font-semibold text-white">Recuperar contraseña</button>
            </div>
        </form>
    </div>

    <!-- Contenido del modal -->
    @if ($showModal)
        <div id="modal" class="absolute flex items-center w-64 gap-2 p-4 bg-white rounded-lg shadow-lg top-12" style="left: 50%; transform: translateX(-50%)">
            <p class="flex items-center justify-center p-2 text-green-500 border-2 border-green-500 rounded-full w-fit"><i class="flex fi fi-sr-check"></i></p>
            <p class="text-sm font-bold leading-tight tracking-tighter text-justify">{{ $successMessage }}</p>
            {{-- <p class="text-sm font-bold leading-tight tracking-tighter text-justify">Se ha enviado un mensaje a tu correo electrónico</p> --}}
        </div>

        <script>
            setTimeout(function() {
                @this.set('showModal', false)
            }, 2000); // Oculta el modal después de 5 segundos (5000 milisegundos)
        </script>
    @endif
</div>
