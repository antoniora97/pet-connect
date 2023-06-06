<?php

namespace App\Http\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostComponent extends Component
{
    public $comment;

    public function createPost ($content, $image) {
        Post::create([
            'pet_id' => session('pet')->id,
            'content' => $content,
            'img_path' => basename($image->store('public/post-images/'))
        ]);
    }

    public function updatePost ($postId, $content) {
        $post = Post::find($postId);
        $post->content = $content;
        $post->save();
    }

    public function likePost($postId) {
        $post = Post::find($postId);
        if ($post) {
            $like = $post->likes()->create([
                'pet_id' => session('pet')->id
            ]);
            return $like;
        }
    }

    public function dislikePost ($postId) {
        $post = Post::find($postId);
        if ($post) {
            $like = session('pet')->likes()->where('post_id', $post->id)->first();
            $dislike = $like->delete();
            return $dislike;
        }
    }

    public function addComment ($postId, $comment) {
        if (!empty($comment)) {
            Comment::create([
                'pet_id' => session('pet')->id,
                'post_id' => $postId,
                'content' => $comment
            ]);
        }
    }

    public function render()
    {
        return view('livewire.post');
    }
}
