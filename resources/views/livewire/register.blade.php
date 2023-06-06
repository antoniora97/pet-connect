<div>

    <div class="relative flex items-center justify-center h-10 bg-blue-600">
        <a href="{{ route('index') }}" class="absolute left-0 p-1 text-white focus:bg-none"><i class="fi fi-rr-angle-left"></i></a>
        <p class="text-center text-white">Únete a PetConnect</p>
    </div>

    <!-- Contenido del modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-xl font-bold">¡Registro exitoso!</h2>
                <p class="mb-4">El registro se ha completado correctamente.</p>
                <div class="flex justify-end">
                    <button wire:click="redirectToFeed" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">OK</button>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="register" class="px-3 pt-3 mx-auto">
        <div class="flex flex-col items-center mb-4">
            <input id="name" type="text" placeholder="Cómo te llamas" wire:model="name" class="@error('name') bg-red-200 @enderror w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-center mb-4">
            <input id="email" type="email" wire:model="email" placeholder="Correo electrónico" class="@error('email') bg-red-200 @enderror w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-center mb-4">
            <select id="race" wire:model="race_id" class="@error('race_id') bg-red-200 @enderror w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option>Seleccionar raza</option>
                @foreach ($race_list as $race)
                    <option value="{{ $race['id'] }}">{{ $race['name'] }}</option>
                @endforeach
            </select>
            @error('race_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-center mb-4">
            <input id="username" type="text" wire:model="username" placeholder="Nombre de usuario" class="@error('username') bg-red-200 @enderror w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-center mb-4">
            <input id="password" type="password" wire:model="password" placeholder="Contraseña" class="@error('password') bg-red-200 @enderror w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col items-center mb-4">
            <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : 'Confirmar contraseña' }}" class="@error('password_confirmation') bg-red-200 @enderror w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Registrarse</button>
        </div>
    </form>

    <footer>
        <p class="text-center underline">Pet Connect <i class="fi fi-tr-circle-c"></i></p>
    </footer>
</div>
