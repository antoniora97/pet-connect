<div>
    {{-- Profile information --}}
    <div>
        <div class="flex gap-3 px-5">
            <div class="relative flex justify-center rounded-full h-28 w-28">
                <img src="{{ asset('storage/profile-images/' . $pet->profile_img)}}" alt="">
                @if (session('pet')->id == $pet->id)
                    <a href="{{ route('pet.profile.edit', $pet->id) }}" class="absolute px-3 py-1 text-xs text-white bg-sky-500 rounded-xl -bottom-2">Editar perfil</a>
                @else
                    @if ($pet->isFollower(session('pet')->id))
                        <button class="absolute px-3 py-1 text-xs text-white bg-sky-500 rounded-xl -bottom-2" wire:click="unfollowPet({{session('pet')->id}})">Dejar de seguir</button>
                    @else
                        <button class="absolute px-3 py-1 text-xs text-white bg-sky-500 rounded-xl -bottom-2" wire:click="followPet({{session('pet')->id}})">Seguir</button>
                    @endif
                @endif
            </div>
            <div class="flex flex-col">
                <h2 class="text-xl font-bold">{{ $pet->name }} <span class="text-lg text-slate-500">{{ $pet->username }}</span></h2>
                <p class="text-sm lowercase text-slate-500">{{ $pet->race->name }} | {{ $pet->gender->name }}</p>
                <div class="relative max-w-full px-2 py-1 mt-4 break-words bg-white rounded-lg w-fit">
                    <p class="absolute px-2 text-sm italic rounded bg-sky-200 left-2 -top-3">Biografía</p>
                    <p class="text-sm">{{ $pet->biographie }}</p>
                </div>
            </div>
        </div>

        <div class="py-2 m-auto mt-6 text-center bg-white rounded-lg w-80">
            <p><span class="capitalize">{{ $pet->name }}</span> es @if ($pet->gender->name == 'Macho') un @else una @endif <span class="lowercase">{{ $pet->race->name }}</span></p>
        </div>
        <div class="py-2 m-auto mt-6 text-center bg-white rounded-lg w-80">
            <p><span class="capitalize">{{ $pet->user->person1_name }}</span> es @if ($pet->gender->name == 'Macho') un @else una @endif <span class="lowercase">{{ $pet->race->name }}</span></p>
        </div>
    </div>

    {{-- Profile stats --}}
    <div class="flex justify-center gap-6 p-3 m-auto mt-6 bg-white rounded-lg w-80">
        <div class="flex flex-col items-center">
            <p class="text-xl font-bold">{{ count($pet->posts) }}</p>
            <p class="tracking-tight text-slate-400">Publicaciones</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-xl font-bold">{{ count($pet->followers) }}</p>
            <p class="tracking-tight text-slate-400">Seguidores</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-xl font-bold">{{ count($pet->following) }}</p>
            <p class="tracking-tight text-slate-400">Siguiendo</p>
        </div>
    </div>

    {{-- Posts section --}}
    <div class="grid grid-cols-3 m-auto mt-5 place-items-center w-80">
        @foreach ($pet->posts as $post)
            <div class="w-24 h-24">
                <img src="{{ asset('storage/images/' . $post->img_path )}}" class="object-cover w-full h-full rounded-lg" alt="">
            </div>
        @endforeach
    </div>

    <div class="fixed bottom-0 left-0 w-full p-4 bg-gray-900">
        <nav class="flex items-center justify-between">
            <a href={{ route('index') }} class="p-4 text-2xl text-white hover:text-gray-300"><i class="fi fi-rr-home"></i></a>
            <a href={{ route('post.create') }} class="p-4 text-2xl text-white hover:text-gray-300"><i class="fi fi-rr-edit"></i></a>
            <a href={{ route('profile.pet', session('pet')->id)}} class="p-4 text-2xl text-white hover:text-gray-300"><i class="fi fi-rr-user"></i></a>
        </nav>
    </div>
</div>
