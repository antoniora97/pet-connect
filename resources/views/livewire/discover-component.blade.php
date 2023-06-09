<div>
    <style>
        header a.active {
            font-weight: bold;
        }

        header a.active::before {
            content: "";
            position: absolute;
            bottom: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000;
        }
    </style>

    @livewire('layout.header-component')

    <div class="flex flex-col gap-5 px-3 pb-24">
        @foreach ($pets as $pet)
        <div class="flex flex-col gap-2">
            {{-- pet info --}}
            <div class="flex items-center justify-between">
                <a class="flex items-center gap-3" href={{ route("profile.pet", $pet->id) }}>
                    <img src="{{asset('storage/pet-profile-images/' . $pet->profile_img)}}" alt="" class="w-12 h-12 rounded-full">
                    <p class="font-semibold">{{$pet->username}}</p>
                </a>
                @if ($pet->isFollower(session('pet')->id))
                    <button class="px-2 py-1 bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="unfollowPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-delete-user"></i></button>
                @else
                    <button class="px-2 py-1 bg-gradient-to-r from-sky-400/40 to-purple-400/40" wire:click="followPet({{session('pet')->id}}, {{$pet->id}})"><i class="flex fi fi-rr-following"></i></button>
                @endif
            </div>
            {{-- pet post images --}}
            @if (count($pet->posts)!=0)
                <div class="flex gap-2 py-2 overflow-x-scroll @if (count($pet->posts)<4) scrollbar @endif">
                    @foreach ($pet->posts as $post)
                    <div class="relative flex">
                        <div class="relative flex items-center justify-center w-24 rounded-lg h-44 bg-slate-700/60">
                            <img src="{{asset('storage/post-images/' . $post->img_path)}}" alt="" class="object-cover w-full h-full rounded-lg">
                        </div>
                        <p class="absolute text-sm font-semibold text-white right-1">{{timeFormat($post->created_at)}}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center first-letter:capitalize">{{$pet->name}} aún no ha subido ninguna foto</p>
            @endif
        </div>
        @endforeach
    </div>

    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>
</div>
