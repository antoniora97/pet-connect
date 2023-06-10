<?php

use App\Http\Controllers\LogoutController;
use App\Http\Livewire\DiscoverComponent;
use App\Http\Livewire\EditHumanProfileComponent;
use App\Http\Livewire\EditPetProfileComponent;
use App\Http\Livewire\Feed;
use App\Http\Livewire\Home;
use App\Http\Livewire\HumanProfileComponent;
use App\Http\Livewire\HumanRegister;
use App\Http\Livewire\PasswordForgot;
use App\Http\Livewire\PasswordReset;
use App\Http\Livewire\PetProfileComponent;
use App\Http\Livewire\PetRegister;

use App\Http\Livewire\Posts\CommentsComponent;
use App\Http\Livewire\Posts\CreatePostComponent;
use App\Http\Livewire\Posts\EditPostComponent;
use App\Http\Livewire\Posts\PostDetailComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', Home::class)->name('index');
    // Route::get('/register', Register::class)->name('register');
    Route::get('/human-register', HumanRegister::class)->name('register.human');
    Route::get('/password-forgot', PasswordForgot::class)->name('password.forgot');
    Route::get('/password-reset/{token}', PasswordReset::class)->name('password.reset');
});


Route::middleware('auth')->group(function () {
    Route::get('/human-profile/{userId}', HumanProfileComponent::class)->name('profile.human');
    Route::get('/edit-human-profile/{userId}', EditHumanProfileComponent::class)->name('human.profile.edit');
    Route::get('/pet-profile/{petId}', PetProfileComponent::class)->name('profile.pet');
    Route::get('/edit-pet-profile/{petId}', EditPetProfileComponent::class)->name('pet.profile.edit');
    Route::get('/pet-register', PetRegister::class)->name('register.pet');
    Route::post('logout', LogoutController::class)->name('logout');


    Route::get('/feed', Feed::class)->name('feed');
    Route::get('/discover', DiscoverComponent::class)->name('discover');

    Route::get('/create-post', CreatePostComponent::class)->name('post.create');
    Route::get('/edit-post/{postId}', EditPostComponent::class)->name('post.edit');
    // Route::get('/comments/{postId}', CommentsComponent::class)->name('post.comments');
    Route::get('/post/{postId}', PostDetailComponent::class)->name('post.detail');
});
