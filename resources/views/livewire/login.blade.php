<div>
    <div class="flex items-center justify-center py-8">
        <h1 class="text-xl font-bold">Inicio de sesión</h1>
    </div>

    <form wire:submit.prevent="login" class="flex flex-col gap-5 tracking-tighter">
        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="email" class="font-semibold">Correo electrónico</label>
            <input placeholder="ejemplo@gmail.com" type="text" id="email" wire:model="email" class="text-black bg-transparent outline-none">
            @error('email')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col p-3 bg-white border-2 border-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <label for="password" class="font-semibold">Contraseña</label>
            <input placeholder="&#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679; &#9679;" type="password" id="password" wire:model="password" class="text-black bg-transparent outline-none">
            @error('password')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @if ($result_message)
            <div>
                <p class="text-sm text-center text-red-600">{{$result_message}}</p>
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('password.forgot') }}" class="text-blue-500">¿Has olvidado tu contraseña?</a>
        </div>

        <div class="p-3 text-white bg-sky-400 rounded-br-xl rounded-bl-xl rounded-tl-xl">
            <button type="submit" class="w-full font-semibold text-white">Iniciar sesión</button>
        </div>
    </form>
</div>
