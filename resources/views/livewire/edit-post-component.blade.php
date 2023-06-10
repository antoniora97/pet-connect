<div class="flex flex-col items-center h-screen px-2 py-2 overflow-scroll bg-gray-100 scrollbar">
    <form wire:submit.prevent="updatePost" class="w-full max-w-md p-6 mb-24 bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Editar publicación</h2>
            <button wire:click='cancelEdit'><i class="flex fi fi-sr-cross"></i></button>
        </div>

        <div class="mb-4 rounded-lg">
            <img src="{{ asset('storage/post-images/' . $post->img_path) }}" alt="" class="object-cover w-full h-full rounded-lg">
        </div>

        <div class="mb-4">
            <label for="content" class="text-gray-700">Contenido:</label>
            <textarea id="content" wire:model="content" class="w-full p-2 bg-gray-100 border border-gray-300 rounded-lg outline-none resize-none scrollbar" rows="2" maxlength="50"></textarea>
            @error('content') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-lg bg-gradient-to-r from-sky-300/70 to-purple-400/70">Editar publicación</button>
        </div>
    </form>
</div>
