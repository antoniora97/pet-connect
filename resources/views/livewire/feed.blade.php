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

        /* post */
        .post {
            height: 22em;
        }
    </style>

    @livewire('layout.header-component')

    {{-- posts section --}}
    <div class="px-1 pb-20">
        @foreach ($posts as $post)
        {{-- post card --}}
        <div class="relative w-full mb-2 text-white post rounded-xl">
            {{-- post img --}}
            <a href="{{ route('post.detail', $post->id) }}">
                <img src="{{asset('storage/post-images/' . $post->img_path)}}" alt="Imagen del post" class="object-cover w-full h-full rounded-xl">
            </a>
            {{-- pet profile --}}
            <a href={{ route('profile.pet', $post->pet->id)}} class="absolute flex items-center gap-2 bottom-16 left-2">
                <div class="flex-shrink-0 w-8 h-8 overflow-hidden rounded-full">
                    <img src="{{ asset('storage/pet-profile-images/' . $post->pet->profile_img) }}" alt="Imagen de perfil" class="object-cover w-full h-full">
                </div>
                <p class="font-bold text-white">{{$post->pet->username}}</p>
            </a>
            {{-- post likes --}}
            <div class="absolute flex items-center gap-2 text-white right-2 bottom-14">
                <p class="text-sm">{{  $post->likes->count() }}</p>
                @if ($pet->likes()->where('post_id', $post->id)->first())
                    <button wire:click="dislikePost({{ $post->id }})" class="text-3xl text-amber-700"><i class="flex fi fi-ss-bone"></i></button>
                @else
                    <button wire:click="likePost({{ $post->id }})" class="text-3xl"><i class="flex fi fi-rr-bone"></i></button>
                @endif
            </div>
            {{-- post comments --}}
            <div class="absolute flex items-center gap-2 text-white right-2 bottom-4">
                <p class="text-sm">{{ $post->comments->count() }}</p>
                <a class="text-3xl" href="{{ route('post.comments', $post->id) }}"><i class="flex fi fi-rr-comment"></i></a>
            </div>
            {{-- post content --}}
            <div class="absolute w-48 p-2 rounded-lg bottom-2 left-2 bg-slate-800/70">
                <p class="mb-1 font-semibold leading-none truncate">{{ $post->content }}</p>
                <p class="text-sm font-semibold">{{ formatFecha($post->created_at) }}</p>
            </div>
            {{-- edit post --}}
            <div class="absolute text-2xl right-2 top-2">
                <a href="{{ route('post.edit', $post->id) }}"><i class="fi fi-rr-edit"></i></a>
            </div>
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
