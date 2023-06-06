<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pet_id',
        'pet_id_following'
    ];

    public function petFollower () {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function petFollowing () {
        return $this->belongsTo(Pet::class, 'pet_id_following');
    }
}
