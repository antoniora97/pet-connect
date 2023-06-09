<div class="flex flex-col justify-center tracking-tighter scrollbar lg:px-80">
    {{-- Estilos para ocultar la barra de desplazamiento en navegadores compatibles --}}
    <style>

        .conectado {
            animation: grow-up-and-down 1s ease-in-out infinite;
        }

        @keyframes grow-up-and-down {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
    </style>

    {{-- Header --}}
    <div class="flex items-center justify-between py-2">
        {{-- <button onclick="history.back()" class="text-xl"><i class="flex fi fi-rr-angle-left"></i></button> --}}
        <h1 class="w-full font-semibold text-center">Perfil de humano</h1>
        @if (session('pet')->user_id == $user->id)
            <button id="bg-img-submit" wire:click="logout" class="absolute text-xl right-2"><i class="flex fi fi-sr-power"></i></button>
        @endif
    </div>

    {{-- Background image --}}
    @if(auth()->user()->id == $user->id)
    <form wire:submit.prevent="setBgImage" class="relative w-full h-48 bg-slate-300">
        <img src="{{asset('storage/human-bg-images/' . $user->bg_image)}}" alt="" class="object-cover w-full h-full">
        @if ($showBgImgLabel)
        <label wire:click="hiddenBgImgLabel" id="bg-img-label" for="bg-image" class="absolute p-2 rounded-full bg-slate-400/20 top-2 right-2 backdrop-blur"><i class="flex text-lg text-sky-600 fi fi-rr-pencil"></i></label>
        @else
        <button wire:click="setBgImage" class="absolute p-2 rounded-full bg-slate-400/20 top-2 right-2 backdrop-blur"><i class="flex text-lg text-sky-600 fi fi-rr-check"></i></button>
        @endif
        <input type="file" id="bg-image" wire:model="bg_image" class="hidden">
    </form>
    @else
    <div class="relative w-full h-48 bg-slate-300">
        <img src="{{asset('storage/human-bg-images/' . $user->bg_image)}}" alt="" class="object-cover w-full h-full">
    </div>
    @endif

    {{-- Profile data --}}
    <div class="absolute flex flex-col w-full px-2 pt-10 pb-20 bg-white rounded-tl-3xl rounded-tr-3xl lg:px-80 lg:left-0" style="top: 13.5rem">
        {{-- Profile image --}}
        @if(auth()->user()->id == $user->id)
        <form wire:submit.prevent="setProfileImage" class="absolute flex items-center justify-center -top-8 left-5 lg:left-96">
            <img src="{{asset('storage/human-profile-images/' . $user->profile_img)}}" alt="profile image" class="object-cover w-16 h-16 rounded-full">
            @if ($showProfileImgLabel)
            <label wire:click="hiddenProfileImgLabel" id="profile-img-label" for="profile-image" class="absolute p-2 rounded-full -right-2 -bottom-2 bg-slate-400/40 backdrop-blur-sm"><i class="flex text-lg text-sky-600 fi fi-rr-pencil"></i></label>
            @else
            <button wire:click="setProfileImage" class="absolute p-2 rounded-full bg-slate-400/40 -right-2 -bottom-2 backdrop-blur"><i class="flex text-lg text-sky-600 fi fi-rr-check"></i></button>
            @endif
            <input type="file" id="profile-image" wire:model="profile_image" class="hidden">
        </form>
        @else
        <div class="absolute flex items-center justify-center -top-8 left-5">
            <img src="{{asset('storage/human-profile-images/' . $user->profile_img)}}" alt="profile image" class="object-cover w-16 h-16 rounded-full">
        </div>
        @endif

        {{-- Persons info --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold capitalize">{{$user->person1_name}}</h2>
                @if($user->person2_name) <h2 class="text-lg font-semibold capitalize">{{$user->person2_name}}</h2> @endif
            </div>
            <div>
                @if (auth()->user()->id == $user->id)
                <a href="{{route('human.profile.edit', $user->id)}}}" class="px-4 py-2 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-sky-300/70 to-purple-400/70">Editar</a>
                @endif
            </div>
        </div>

        {{-- Biographie --}}
        @if (auth()->user()->id == $user->id)
        <div class="relative p-2 mt-2 bg-sky-200/50 rounded-xl">
            <form wire:submit.prevent="setBiographie" class="rounded-lg">
                <div class="scrollbar">
                    <label for="biographie" class="font-semibold">Biografía</label>
                    <textarea id="biographie" wire:model="biographie" maxlength="80" class="w-full bg-transparent border-none rounded outline-none resize-none h-fit focus:border-none scrollbar"></textarea>
                    @error('biographie')<span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="absolute right-2 top-2">
                    <button id="biographie-submit" type="submit" class="flex items-center gap-1 p-1 text-xs font-semibold text-white rounded bg-gradient-to-r from-sky-300/70 to-purple-400/70"><i class="flex fi fi-rr-check"></i>Confirmar cambios</button>
                </div>
            </form>
        </div>
        @else
            @if($biographie)
            <div class="relative p-2 mt-2 bg-sky-200/50 rounded-xl">
                <h2 class="font-semibold">Biografía</h2>
                <textarea id="biographie" wire:model="biographie" maxlength="50" class="w-full bg-transparent border-none rounded outline-none resize-none focus:border-none scrollbar" disabled></textarea>
            </div>
            @endif
        @endif

        {{-- Pets --}}
        <div class="flex flex-col gap-2 mt-5">
            {{-- Title --}}
            <div class="flex justify-between">
                @if (auth()->user()->id == $user->id)
                    @if ($user->person2_name)
                        <h1 class="text-lg font-semibold ">Vuestras mascotas</h1>
                    @else
                        <h1 class="text-lg font-semibold">Tus mascotas</h1>
                    @endif
                @else
                    <h1 class="text-lg font-semibold">Sus mascotas</h1>
                @endif
                {{-- Button to open list of pets --}}
                @if (auth()->user()->id == $user->id)
                <div class="flex items-center justify-center">
                    <button wire:click="toggleListOfPets" class="flex items-center"><i class="flex text-lg fi fi-rr-angle-small-down"></i></button>
                </div>
                @endif
            </div>
            {{-- Pets section --}}
            <div class="pb-2 overflow-x-scroll @if(count($pets) < 4) scrollbar @endif">
                <div class="flex items-center @if(count($pets)>=4) justify-between @endif gap-2">
                    @foreach ($pets as $pet)
                    <div class="flex flex-col items-center justify-center">
                        <a href="{{route('profile.pet', $pet->id)}}" class="relative flex items-center justify-center w-20 h-20 rounded-xl bg-slate-700/60">
                            <img src="{{asset('storage/pet-profile-images/' . $pet->profile_img)}}" alt="" class="w-full h-full rounded-xl">
                        </a>
                        <div class="flex flex-col items-center justify-center">
                            <p class="font-semibold capitalize">{{$pet->name}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- All user pets posts --}}
        <div class="pb-2 mt-5">
            <h1 class="text-lg font-semibold">Galería de fotos</h1>
            @if($showPosts)
                <div class="grid grid-cols-3 gap-2 mt-2 place-items-center">
                    @foreach ($posts as $pet_post)
                        @foreach ($pet_post as $post)
                            <a href="{{route('post.detail', $post->id)}}">
                                <img src="{{asset('storage/post-images/' . $post->img_path)}}" class="object-cover w-32 h-32 rounded-xl" alt="">
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @else
                <p class="text-center">Aún no tienes fotos subidas.</p>
            @endif
        </div>
    </div>

    {{-- Change pet account --}}
    @if ($isOpenListOfPets)
    <div class="fixed top-0 left-0 z-50 w-full h-screen transition ease-in-out delay-500 bg-slate-900/40 lg:w-2/4 lg:m-auto" style="left: 50%; transform: translate(-50%);">
        <div class="absolute bottom-0 left-0 z-20 w-full px-2 overflow-scroll bg-white scrollbar rounded-tl-3xl rounded-tr-3xl max-h-72">
            <div class="relative flex items-center justify-center w-full h-8">
                <h2 class="font-semibold">Cambiar cuenta</h2>
                <button wire:click='toggleListOfPets' class="absolute right-2"><i class="flex text-xs fi fi-rr-cross"></i></button>
            </div>
            @foreach ($pets as $pet)
            <button wire:click="changePet({{$pet->id}})" class="flex items-center justify-between w-full h-16">
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12">
                        <img src="{{asset('storage/pet-profile-images/' . $pet->profile_img)}}" class="w-full h-full rounded-full" alt="">
                    </div>
                    <p>{{$pet->username}}</p>
                </div>
                @if (session('pet')->id == $pet->id)
                <div class="flex items-center justify-center w-5 h-5 border-2 border-green-500 rounded-full">
                    <div class="w-3 h-3 bg-green-500 rounded-full conectado"></div>
                </div>
                @endif
            </button>
            @endforeach
            <div class="flex items-center h-16 gap-2">
                <a href="{{route('register.pet')}}" class="flex items-center w-full gap-2"><i class="flex items-center justify-center w-12 h-12 text-3xl rounded-full bg-slate-300 fi fi-rr-plus"></i><p>Añadir cuenta</p></a>
            </div>
        </div>
    </div>
    @endif

    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>

    {{-- Javascript --}}
    <script>
        let biographie = document.getElementById('biographie')
        let submit = document.getElementById('biographie-submit')

        submit.addEventListener('click', () => {
            setTimeout(() => {
                submit.classList.remove('from-sky-300/70')
                submit.classList.remove('to-purple-400/70')
                submit.classList.add('from-green-300/70')
                submit.classList.add('to-sky-300/70')
            }, 100);
        })
    </script>
</div>
