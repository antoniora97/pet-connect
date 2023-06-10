<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class PostDetailComponent extends Component
{
    public $post;
    public $comment;
    public $comments;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($postId) {
        $this->post = Post::find($postId);
        $this->comments = $this->post->comments->sortByDesc('created_at');
    }

    public function likePost () {
        (new PostComponent())->likePost($this->post->id);
        $this->emit('refreshComponent');
    }

    public function dislikePost () {
        (new PostComponent())->dislikePost($this->post->id);
        $this->emit('refreshComponent');
    }

    public function addComment () {
        (new PostComponent())->addComment($this->post->id, $this->comment);
        $this->comment = '';

        return redirect()->to(route('post.detail', $this->post->id));
    }

    public function render() {
        return view('livewire.post-detail-component');
    }
}
