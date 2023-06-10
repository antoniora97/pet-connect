<div class="sm:w-2/5 sm:m-auto lg:w-2/5">
    <div>
        <div class="flex items-center justify-between px-2 py-3">
            <h1 class="font-semibold">Publicación de {{$post->pet->username}}</h1>

            {{-- edit post --}}
            @if (session('pet')->id == $post->pet->id)
            <div class="text-xl">
                <a href="{{ route('post.edit', $post->id) }}"><i class="flex fi fi-rr-edit"></i></a>
            </div>
            @endif
        </div>

        {{-- img --}}
        <div>
            <img src="{{ asset('storage/post-images/' . $post->img_path)}}" alt="">
            <div class="flex justify-between px-2 py-3 shadow-xl rounded-br-xl rounded-bl-xl bg-slate-100">
                <div class="w-4/5 break-words">
                    @if (strlen($post->content) > 100)
                        <p class="content">{{ substr($post->content, 0, 100) . "..." }}</p>
                        <p class="content-more" style="display: none;">{{ $post->content }}</p>
                        <button class="font-bold" onclick="toggleContent()" id="show-more-button">Ver más</button>
                    @else
                        <p>{{$post->content}}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <p class="text-sm">{{  $post->likes->count() }}</p>
                    @if (session('pet')->likes()->where('post_id', $post->id)->first())
                        <button wire:click="dislikePost({{ $post->id }})" class="text-3xl text-amber-700">
                            <i class="flex fi fi-ss-bone"></i>
                        </button>
                    @else
                        <button wire:click="likePost({{ $post->id }})" class="text-3xl">
                            <i class="flex fi fi-rr-bone"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .content.more {
                display: none;
            }
        </style>

        <script>
            function toggleContent() {
                const content = document.querySelector('.content');
                const contentMore = document.querySelector('.content-more');
                const showMoreButton = document.getElementById('show-more-button');

                if (content.classList.contains('more')) {
                    content.classList.remove('more');
                    contentMore.style.display = 'none';
                    showMoreButton.innerText = 'Ver más';
                } else {
                    content.classList.add('more');
                    contentMore.style.display = 'block';
                    showMoreButton.innerText = 'Ver menos';
                }
            }
        </script>



        {{-- Leave a comment --}}
        <div class="flex justify-between w-full gap-2 px-2 py-2">
            <input type="text" wire:model="comment" placeholder="Escribe un comentario..." class="w-4/5 px-3 py-1 border-2 rounded-full border-sky-400">
            <button wire:click="addComment" class="px-3 py-1 rounded-xl bg-gradient-to-r from-sky-400/30 to-purple-400/30">Enviar</button>
        </div>

        {{-- Comments section --}}
        <div class="flex flex-col gap-2 px-1 pb-20">
            @foreach ($comments as $comment)
                <div class="p-2 border rounded-xl bg-sky-200/30">
                    <div class="flex items-center w-10 h-10 gap-2 rounded-full">
                        <img src="{{ asset('storage/pet-profile-images/' . $comment->pet->profile_img)}}" alt="" class="rounded-full">
                        <p class="font-semibold">{{ $comment->pet->username }}</p>
                    </div>
                    <div class="w-4/5 ml-12 break-words">
                        <p class="text-start">{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="fixed flex items-center justify-between gap-8 px-5 py-3 text-2xl rounded-full backdrop-blur text-slate-50 bottom-5 bg-gradient-to-r from-sky-300/50 to-purple-400/50" style="left: 50%; transform: translateX(-50%);">
        <a href={{ route('index') }}><i class="fi fi-rr-home"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-add"></i></a>
        <a href={{ route('post.create') }}><i class="fi fi-rr-calendar"></i></a>
        <a href={{ route('profile.pet', session('pet')->id)}}><i class="fi fi-rr-user"></i></a>
    </div>
</div>
