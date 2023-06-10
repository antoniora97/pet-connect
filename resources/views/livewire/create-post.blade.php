<div class="flex flex-col items-center h-screen px-2 py-2 overflow-scroll bg-gray-100 scrollbar">
    <form wire:submit.prevent="createPost" class="w-full max-w-md p-6 mb-24 bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Crear publicación</h2>
            <button wire:click='cancelCreate'><i class="flex fi fi-sr-cross"></i></button>
        </div>

        <div class="mb-4 border-2 border-black border-dashed rounded-lg bg-slate-200">
            <div class="flex items-center justify-center w-full h-full p-4 @if($image) p-0 @endif">
                <label for="image" class="relative flex flex-col items-center justify-between w-full h-full p-2 text-gray-700">
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" class="object-contain max-h-64 lg:max-h-52 h-fit w-fit" alt="Vista previa de la imagen">
                    @endif
                    <i class="z-30 flex text-xl fi fi-rr-upload @if($image) pt-2 @endif"></i>
                </label>
            </div>
            <input type="file" id="image" wire:model="image" class="hidden">
            @error('image') <span class="px-2 text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="text-gray-700">Contenido:</label>
            <textarea id="content" wire:model="content" class="w-full p-2 bg-gray-100 border border-gray-300 rounded-lg outline-none resize-none scrollbar" rows="2" maxlength="50"></textarea>
            @error('content') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-lg bg-gradient-to-r from-sky-300/70 to-purple-400/70">Crear publicación</button>
        </div>
    </form>

    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>
</div>
