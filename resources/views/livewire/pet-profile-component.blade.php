<div class="relative w-full h-screen lg:w-3/5 lg:m-auto @if($showFollowers || $showFollowing) overflow-hidden @endif">
    {{-- Header --}}
    <div class="px-3 bg-white">
        <div class="relative flex items-center justify-between py-2 border-b">
            <h1 class="font-semibold first-letter:capitalize">{{$pet->name}}</h1>
            @if (session('pet')->id == $pet->id)
            <button id="header-btn"><i class="flex fi fi-rr-menu-dots"></i></button>
            @endif
        </div>
        <div id="actions" class="absolute left-0 z-30 flex flex-col hidden w-full h-full px-3 rounded-tl-lg rounded-bl-lg rounded-br-lg lg:w-3/5 lg:left-52 backdrop-blur bg-white/30">
            <a href="{{ route('pet.profile.edit', $pet->id)}}" class="py-1 bg-white border-b">Editar perfil</a>
            @if (count($pet->user->pets)>1) <button wire:click='openConfirmDelete' class="py-1 bg-white border-b text-start">Eliminar cuenta</button> @endif
        </div>
    </div>

    @if ($confirmDeleteModal)
        <div class="py-2 text-sm">
            <p class="text-center">Vas a borrar tu cuenta de forma permanente</p>
            <div class="flex justify-around mt-4">
                <button wire:click='deletePet' class="px-2 py-1 rounded-lg to-purple-400/30 bg-gradient-to-r from-sky-400/30">Confirmar</button>
                <button wire:click='closeConfirmDelete' class="px-2 py-1 rounded-lg to-slate-400/30 bg-gradient-to-r from-red-400/50">Cancelar</button>
            </div>
        </div>
    @endif

    <div class="relative bg-white shadow-lg rounded-br-xl rounded-bl-xl">
        {{-- Profile image --}}
        @if(session('pet')->id == $pet->id)
        <form wire:submit.prevent="setProfileImage" class="relative flex items-center justify-center w-full pt-5">
            <div class="flex items-center justify-center w-full rounded-full">
                <img src="{{ asset('storage/pet-profile-images/' . $pet->profile_img)}}" alt="" class="object-cover w-24 h-24 p-1 rounded-full outline outline-slate-200">
            </div>
            @if ($showProfileImgLabel)
            <label wire:click="hiddenProfileImgLabel" id="profile-img-label" for="profile-image" class="absolute p-2 rounded-full -bottom-3 bg-slate-400/40 backdrop-blur-sm"><i class="flex text-lg text-sky-600 fi fi-rr-pencil"></i></label>
            @else
            <button wire:click="setProfileImage" class="absolute p-2 rounded-full -bottom-3 bg-slate-400/40 backdrop-blur"><i class="flex text-lg text-sky-600 fi fi-rr-check"></i></button>
            @endif
            <input type="file" id="profile-image" wire:model="profile_image" class="hidden">
        </form>
        @else
        <div class="flex items-center justify-center w-full pt-5 rounded-full">
            <img src="{{ asset('storage/pet-profile-images/' . $pet->profile_img)}}" alt="" class="object-cover w-24 h-24 p-1 rounded-full outline outline-slate-200">
        </div>
        @endif

        {{-- Pet information --}}
        <div class="flex flex-col items-center justify-center mt-2">
            <h2 class="text-xl font-bold">{{ $pet->username }}</h2>
            <p class="text-sm lowercase text-slate-500">{{ $pet->race->name }} | {{ $pet->gender->name }}</p>
        </div>

        {{-- Actions: follow/unfollow, edit, message --}}
        @if (session('pet')->id != $pet->id)
        <div class="flex justify-center gap-2 px-5 mt-2">
                @if ($pet->isFollower(session('pet')->id))
                    <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="unfollowPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-delete-user"></i></button>
                @else
                    <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="followPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-following"></i></button>
                @endif
                <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40"><i class="fi fi-rr-envelope-plus"></i></button>
                <button wire:click="redirectToPerson" class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40"><i class="flex fi fi-rr-comment-user"></i></button>
            </div>
        @endif

        {{-- Profile stats --}}
        <div id="stats" class="flex items-center justify-center m-auto mt-5 bg-white rounded-lg gap-7">
            <a href="#posts" class="flex flex-col items-center">
                <p class="font-semibold">{{ count($pet->posts) }}</p>
                <p class="text-sm tracking-tight text-slate-400">Publicaciones</p>
            </a>
            <button wire:click="openFollowers" class="flex flex-col items-center">
                <p class="font-semibold">{{ count($pet->followers) }}</p>
                <p class="text-sm tracking-tight text-slate-400">Seguidores</p>
            </button>
            <button wire:click="openFollowing" class="flex flex-col items-center">
                <p class="font-semibold">{{ count($pet->following) }}</p>
                <p class="text-sm tracking-tight text-slate-400">Siguiendo</p>
            </button>
        </div>

        {{-- Pet biographie --}}
        <div id="bio" class="flex justify-center px-3 mt-5">
            <p class="text-sm text-center text-slate-400">"{{$pet->biographie}}"</p>
        </div>

        <div class="flex items-center justify-center h-12">
            <button id="up" class="flex items-center justify-center w-full h-full"><i id="upIcon" class="flex text-xl fi fi-sr-minus-small"></i></button>
            <button id="down" class="flex items-center justify-center hidden w-full h-full"><i id="downIcon" class="flex items-center justify-center text-xl fi fi-sr-minus-small"></i></button>
        </div>
    </div>

    {{-- Posts section --}}
    <div id="posts" class="grid grid-cols-3 gap-1 px-1 pt-1 pb-20 place-items-center lg:m-auto">
        @if (count($pet->posts) > 0)
            @foreach ($pet->posts as $post)
                <a href="{{ route('post.detail', $post->id)}}" class="w-full h-28 sm:h-64 sm:w-full lg:h-52">
                    <img src="{{ asset('storage/post-images/' . $post->img_path )}}" class="object-cover w-full h-full rounded-lg" alt="">
                </a>
            @endforeach
        @else
            <p class="col-span-3 pt-12">Sin fotos subidas</p>
        @endif
    </div>

    {{-- Followers section --}}
    @if ($showFollowers)
    <div class="fixed top-0 left-0 z-50 w-full h-full bg-white/30 backdrop-blur">
        <div class="absolute p-2 px-3 rounded-lg shadow-xl bg-slate-200" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <button wire:click='closeFollowers' class="absolute top-0 right-0"><i class="flex text-2xl fi fi-sr-cross-small"></i></button>
            <h4 class="w-full px-3 py-1 text-center border-b border-black">Seguidores</h4>
            <div class="flex flex-col w-full gap-2 px-1 py-2 overflow-scroll max-h-48 scrollbar">
                @if (count($followers) > 0)
                    @foreach ($followers as $follower)
                        <?php $pet = App\Models\Pet::find($follower['pet_id']); ?>
                        <div class="flex justify-between gap-12">
                            <a href="{{route('profile.pet', $pet->id)}}" class="flex items-center gap-2">
                                <img src="{{ asset('storage/pet-profile-images/' . $pet->profile_img)}}" class="object-cover w-8 h-8 rounded-full" alt="">
                                <p>{{$pet->username}}</p>
                            </a>
                            @if (session('pet')->id != $pet->id)
                                @if ($pet->isFollower(session('pet')->id))
                                    <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="unfollowPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-delete-user"></i></button>
                                @else
                                    <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="followPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-following"></i></button>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="px-3 py-1">Sin seguidores</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- Following section --}}
    @if ($showFollowing)
        <div class="fixed top-0 left-0 z-50 w-full h-full bg-white/30 backdrop-blur">
            <div class="absolute p-2 px-3 rounded-lg shadow-xl bg-slate-200" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <button wire:click='closeFollowing' class="absolute top-0 right-0"><i class="flex text-2xl fi fi-sr-cross-small"></i></button>
                <h4 class="w-full px-3 py-1 text-center border-b border-black">Seguidos</h4>
                <div class="flex flex-col w-full gap-2 px-1 py-2 overflow-scroll max-h-48 scrollbar">
                    @if (count($following) > 0)
                        @foreach ($following as $following)
                            <?php $pet = App\Models\Pet::find($following['pet_id_following']); ?>
                            <div class="flex justify-between gap-12">
                                <a href="{{route('profile.pet', $pet->id)}}" class="flex items-center gap-2">
                                    <img src="{{ asset('storage/pet-profile-images/' . $pet->profile_img)}}" class="object-cover w-8 h-8 rounded-full" alt="">
                                    <p>{{$pet->username}}</p>
                                </a>
                                @if (session('pet')->id != $pet->id)
                                    @if ($pet->isFollower(session('pet')->id))
                                        <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="unfollowPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-delete-user"></i></button>
                                    @else
                                        <button class="px-2 py-1 rounded bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="followPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-following"></i></button>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="px-3 py-1">Sin seguidos</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Nav --}}
    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>

    <script>
        let button = document.getElementById('header-btn')
        let actions = document.getElementById('actions')
        let body = document.getElementsByTagName('body')[0]


        button.addEventListener('click', () => {
            actions.classList.toggle('hidden')
            body.classList.toggle('overflow-hidden')
        })

        let upButton = document.getElementById('up')
        let upIcon = document.getElementById('upIcon')
        let downButton = document.getElementById('down')
        let downIcon = document.getElementById('downIcon');
        let biographieDiv = document.getElementById('bio')
        let statsDiv = document.getElementById('stats')

        downButton.addEventListener('click', () => {
            biographieDiv.classList.toggle('hidden')
            statsDiv.classList.toggle('hidden')
            upButton.classList.toggle('hidden')
            downButton.classList.toggle('hidden')
        })

        downButton.addEventListener('mouseover', () => {
            downIcon.classList.remove('fi', 'fi-rr-minus-small')
            downIcon.classList.add('fi', 'fi-rr-angle-small-down')
        })

        downButton.addEventListener('mouseleave', () => {
            downIcon.classList.remove('fi', 'fi-rr-angle-small-down')
            downIcon.classList.add('fi', 'fi-rr-minus-small')
        })

        upButton.addEventListener('mouseover', () => {
            upIcon.classList.remove('fi', 'fi-rr-minus-small')
            upIcon.classList.add('fi', 'fi-rr-angle-small-up')
        })

        upButton.addEventListener('mouseleave', () => {
            upIcon.classList.remove('fi', 'fi-rr-angle-small-up')
            upIcon.classList.add('fi', 'fi-rr-minus-small')
        })

        upButton.addEventListener('click', () => {
            biographieDiv.classList.toggle('hidden')
            statsDiv.classList.toggle('hidden')
            upButton.classList.toggle('hidden')
            downButton.classList.toggle('hidden')
        })
    </script>
</div>
