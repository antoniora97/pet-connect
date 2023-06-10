<?php

namespace App\Http\Livewire\Posts;

use App\Http\Livewire\Posts\PostComponent;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePostComponent extends Component
{
    use WithFileUploads;

    public $pet;
    public $content;
    public $image;

    public function mount () {
        $this->pet = session('pet');
    }

    public function createPost () {
        $this->validate(
            [
                'content' => 'max:50',
                'image' => 'required'
            ],
            [
                'content.max' => 'El contenido no puede exceder los 50 caracteres.',
                'image.required' => 'Se debe incluir una imagen en la publicación.'
            ]
        );
        (new PostComponent($this->pet))->createPost($this->content, $this->image);
        redirect()->to(route('feed'));
    }

    public function cancelCreate () {
        return redirect()->to(route('feed'));
    }

    public function render () {
        return view('livewire.create-post');
    }
}
