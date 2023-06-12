<?php

namespace App\Http\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class PostDetailComponent extends Component
{
    public $post;
    public $comment;
    public $comments;
    public $deleteConfirmationModal;
    public $editingComment;
    public $deletingComment;
    public $editedCommentId;
    public $deletingCommentId;
    public $editedCommentContent;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount ($postId) {
        $this->post = Post::find($postId);
        $this->comments = $this->post->comments->sortByDesc('created_at');
        $this->deleteConfirmationModal = false;
        $this->editingComment = false;
        $this->editedCommentId = null;
        $this->editedCommentContent = '';
        $this->deletingComment = false;
        $this->deletingCommentId = null;
    }

    public function openEditingComment($commentId) {
        $this->editingComment = true;
        $this->editedCommentId = $commentId;
        $this->editedCommentContent = Comment::findOrFail($commentId)->content;
    }

    public function closeEditingComment() {
        $this->editingComment = false;
        $this->editedCommentId = null;
        $this->editedCommentContent = '';
    }

    public function likePost () {
        (new PostComponent())->likePost($this->post->id);
        $this->emit('refreshComponent');
    }

    public function openConfirmDelete () {
        $this->deleteConfirmationModal = true;
    }

    public function closeConfirmDelete () {
        $this->deleteConfirmationModal = false;
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

    public function deleteComment ($commentId) {
        (new PostComponent())->deleteComment($commentId);
        $this->emit('refreshComponent');
    }

    public function openDeleteComment ($commentId) {
        $this->deletingCommentId = Comment::find($commentId)->id;
        $this->deletingComment = true;
    }

    public function closeDeleteComment () {
        $this->deletingCommentId = null;
        $this->deletingComment = false;
    }

    public function editComment($commentId) {
        $comment = Comment::findOrFail($commentId);
        if ($this->editedCommentContent) {
            $comment->content = $this->editedCommentContent;
            $comment->save();
        }
        $this->editedCommentId = null;
        $this->editedCommentContent = '';
        $this->editingComment = false;
        $this->emit('refreshComponent');
    }

    public function deletePost () {
        $this->post->delete();
        return redirect()->to(route('feed'));
    }

    public function render() {
        return view('livewire.post-detail-component');
    }
}
