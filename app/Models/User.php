<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;



    // Relationships
    // function posts()
    // {
    //     return $this->hasMany(
    //         Post::class,
    //         'user_id',
    //         'id'
    //     );
    // }
    function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
