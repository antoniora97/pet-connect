<?php

namespace App\Http\Livewire\Posts;

use App\Http\Livewire\Posts\PostComponent;
use App\Models\Post;
use Livewire\Component;

class EditPostComponent extends Component {
    public $post;
    public $content;
    public $successMessage;

    public function mount ($postId) {
        $this->post = Post::find($postId);
        $this->content = $this->post->content;
    }

    public function updatePost()
    {
        (new PostComponent())->updatePost($this->post->id, $this->content);
        return redirect()->to(route('feed'));
    }

    public function render()
    {
        return view('livewire.edit-post-component');
    }
}
