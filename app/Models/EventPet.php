<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPet extends Model
{
    use HasFactory;

    public function pets () {
        return $this->hasMany(Pet::class);
    }

    public function events () {
        return $this->hasMany(Event::class);
    }
}
