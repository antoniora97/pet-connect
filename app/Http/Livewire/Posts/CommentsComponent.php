<?php

namespace App\Http\Livewire\Posts;

use App\Http\Livewire\Posts\PostComponent;
use App\Models\Post;
use Livewire\Component;

class CommentsComponent extends Component
{
    public $comments;
    public $comment;
    public $post;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($postId) {
        $this->post = Post::find($postId);
        $this->comments = $this->post->comments;
    }

    public function addComment () {
        (new PostComponent())->addComment($this->post->id, $this->comment);
        $this->comment = '';
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.comments-component');
    }
}
