<div class="max-w-4xl p-2 mx-auto ">
    @if ($successMessage)
        <div class="p-4 text-green-800 bg-green-200">{{ $successMessage }}</div>
    @endif
    <form wire:submit.prevent="updatePost" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold">Editar Publicación</h2>

        <div class="flex items-center justify-center">
            <img src="{{ asset('storage/images/' . $post->img_path) }}" alt="" class="object-cover w-full h-full">
        </div>

        <div class="mt-4 mb-4">
            <label for="content" class="block font-semibold">Contenido:</label>
            <textarea id="content" wire:model="content" class="w-full px-4 py-2 border border-gray-300 rounded"></textarea>
            @error('content')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600">Guardar</button>
        </div>
    </form>
</div>
