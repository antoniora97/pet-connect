<div class="container">
    <h1>Comentarios</h1>

    <div>
        <input type="text" wire:model="comment" placeholder="Escribe un comentario...">
        <button wire:click="addComment">Enviar</button>
    </div>

    @foreach ($comments as $comment)
        <div class="card">
            <div class="card-body">
                <p>{{ $comment->content }}</p>
            </div>
        </div>
    @endforeach
</div>
