<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'profile_img',
        'biographie',
        'gender_id',
        'race_id',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function race () {
        return $this->belongsTo(Race::class, 'race_id');
    }

    public function posts () {
        return $this->hasMany(Post::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    public function following () {
        return $this->hasMany(Follow::class, 'pet_id');
    }

    public function followers () {
        return $this->hasMany(Follow::class, 'pet_id_following');
    }

    public function isFollower ($petId) {
        return $this->followers()->where('pet_id', $petId)->first();
    }

    public function gender () {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
}
