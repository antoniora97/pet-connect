<div class="lg:w-3/5 lg:m-auto @if($deleteConfirmationModal) h-screen overflow-hidden @endif">

    <style>
        .content.more {
            display: none;
        }
    </style>

    <div>
        <div class="flex items-center justify-between px-2 py-3">
            <h1 class="font-semibold">Publicación de {{$post->pet->username}}</h1>

            @if (session('pet')->id == $post->pet->id)
            <div class="flex items-center gap-2">
                {{-- edit post --}}
                <div class="text-xl rounded-full bg-sky-600/60">
                    <a href="{{ route('post.edit', $post->id) }}" class="block p-2 text-white"><i class="flex fi fi-rr-edit"></i></a>
                </div>
                {{-- delete post --}}
                <div class="text-xl rounded-full bg-red-600/60">
                    <button wire:click="openConfirmDelete" class="p-2 text-white"><i class="flex fi fi-rr-trash"></i></button>
                </div>
            </div>
            @endif

            {{-- Confirm delete modal --}}
            @if ($deleteConfirmationModal)
            <div class="absolute z-50 flex flex-col justify-center w-full h-screen gap-2 p-12 bg-white" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <p class="text-sm font-semibold text-center">Esta publicación se eliminará. ¿Estás de acuerdo?</p>
                <div class="flex items-center justify-center gap-2 text-sm font-semibold">
                    <button class="px-2 py-1 rounded-full bg-red-400/60" wire:click="deletePost">Confirmar</button>
                    <button class="px-2 py-1 rounded-full bg-slate-300" wire:click="closeConfirmDelete">Cancelar</button>
                </div>
            </div>
            @endif
        </div>

        {{-- Post content --}}
        <div>
            <img src="{{ asset('storage/post-images/' . $post->img_path)}}" alt="" class="w-full">
            <div class="flex justify-between px-2 py-3 shadow-xl rounded-br-xl rounded-bl-xl bg-slate-100">
                <div class="break-words">
                    @if (strlen($post->content) > 100)
                        <p class="content">{{ substr($post->content, 0, 100) . "..." }}</p>
                        <p class="content-more" style="display: none;">{{ $post->content }}</p>
                        <button class="font-bold" onclick="toggleContent()" id="show-more-button">Ver más</button>
                    @else
                        <p>{{$post->content}}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Leave a comment --}}
        <div class="flex justify-between w-full gap-2 px-2 py-2">
            <input type="text" wire:model="comment" placeholder="Escribe un comentario..." class="w-4/5 px-3 py-1 border-2 rounded-full border-sky-400">
            <button wire:click="addComment" class="px-3 py-1 rounded-xl bg-gradient-to-r from-sky-400/30 to-purple-400/30">Enviar</button>
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

        {{-- Comments section --}}
        <div class="flex flex-col gap-2 px-1 pb-20">
            @foreach ($comments as $comment)
                <div class="p-2 border rounded-xl bg-sky-200/30">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('storage/pet-profile-images/' . $comment->pet->profile_img)}}" alt="" class="w-10 h-10 rounded-full">
                            <p class="font-semibold">{{ $comment->pet->username }}</p>
                        </div>
                    </div>
                    <div class="relative flex justify-between ml-12 break-all">
                        @if ($editingComment && $editedCommentId == $comment->id)
                            <div class="flex items-center justify-between w-full gap-2">
                                <textarea wire:model="editedCommentContent" maxlength="350" class="w-full bg-transparent outline-none h-fit" type="text"></textarea>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editComment({{ $comment->id }})" id="editConfirmBtn"><i class="flex p-1 text-green-400 border-2 border-green-400 rounded-full fi fi-rr-check"></i></button>
                                    <button wire:click='closeEditingComment'><i class="flex p-1 text-red-400 border-2 border-red-400 rounded-full fi fi-sr-cross-small"></i></button>
                                </div>
                            </div>
                        @else
                            <div class="flex w-full gap-6">
                                @if (!$deletingComment || $deletingCommentId != $comment->id)
                                <div class="flex flex-col justify-between w-full gap-2">
                                    <p class="text-start">{{ $comment->content }}</p>
                                    <p class="text-sm">creado {{ timeFormat($comment->created_at) }} @if($comment->created_at != $comment->updated_at) · editado {{ timeFormat($comment->updated_at) }} @endif</p>
                                </div>
                                    @if ($comment->pet->id == session('pet')->id)
                                    <div class="flex flex-col justify-start gap-2">
                                        <button wire:click="openEditingComment({{ $comment->id }})" class="p-2 text-xl rounded-full bg-sky-600/60"><i class="flex fi fi-rr-edit"></i></button>
                                        <button wire:click="openDeleteComment({{$comment->id}})" class="p-2 text-xl text-white rounded-full bg-red-600/60"><i class="flex fi fi-rr-trash"></i></button>
                                    </div>
                                    @endif
                                @endif
                                @if ($deletingComment && $deletingCommentId == $comment->id)
                                <div class="flex flex-col items-center justify-center w-full h-full gap-2 px-2 pb-2">
                                    <p class="text-sm">Vas a eliminar este comentario. ¿Estás de acuerdo?</p>
                                    <div class="flex gap-2">
                                        <button wire:click='deleteComment({{$comment->id}})' class="px-2 py-1 text-sm bg-red-300 rounded-full">Confirmar</button>
                                        <button wire:click='closeDeleteComment' class="px-2 py-1 text-sm rounded-full bg-slate-300">Cancelar</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif
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
</div>
