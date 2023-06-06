<div class="flex flex-col h-screen px-2 bg-gray-100">
    <form wire:submit.prevent="createPost" enctype="multipart/form-data" class="w-full max-w-md p-6 mb-48 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-gray-800">Nueva publicación</h2>

        <div class="mb-4">
            <label for="content" class="text-gray-700">Contenido:</label>
            <textarea id="content" wire:model="content" class="w-full p-2 bg-gray-100 border border-gray-300 rounded-lg outline-none resize-none" rows="4" maxlength="50"></textarea>
            @error('content') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 border-2 border-black border-dashed rounded-lg bg-slate-200">
            <div class="flex items-center justify-center w-full h-full p-4 @if($image) p-0 @endif">
                <label for="image" class="flex items-center justify-center w-full h-full text-gray-700">
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" class="object-contain h-full w-fit" alt="Vista previa de la imagen">
                    @else
                        <i class="flex text-xl fi fi-rr-upload"></i>
                    @endif
                </label>
            </div>
            <input type="file" id="image" wire:model="image" class="hidden">
            @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-center @if($image) mb-16 @endif">
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-lg bg-gradient-to-r from-sky-300/70 to-purple-400/70">Crear Post</button>
        </div>
    </form>

    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>
</div>
