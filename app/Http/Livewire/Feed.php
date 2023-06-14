<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Posts\PostComponent;
use App\Models\Pet;
use App\Models\Post;
use Livewire\Component;

class Feed extends Component
{
    public $pet;
    public $posts;
    public $comments;
    public $comment;
    public $petFollowingIds;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount () {
        $this->pet = Pet::find(session('pet')->id);
        $this->petFollowingIds = array_merge($this->pet->following->pluck('pet_id_following')->toArray(), [$this->pet->id]);
        $this->posts = Post::whereIn('pet_id', $this->petFollowingIds)->with('comments')->get()->sortByDesc('created_at');
        $this->comments = $this->posts->flatMap(function ($post) {
            return $post->comments;
        });
    }

    public function likePost($postId) {
        (new PostComponent())->likePost($postId);
        $this->emit('refreshComponent');
    }

    public function dislikePost ($postId) {
        (new PostComponent())->dislikePost($postId);
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.feed');
    }
}
