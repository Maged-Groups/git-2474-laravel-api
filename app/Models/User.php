<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
        'updated_at',
        'deleted_at'
    ];


    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'roles',
    ];


    public function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    // Accessors and Mutators (Attributes)
    function roles(): Attribute
    {
        return Attribute::make(
            set: fn($val) => implode(',', $val),
            get: fn($val) => explode(',', $val)
        );
    }

    function name(): Attribute
    {
        return Attribute::make(
            set: fn($val) => ucwords($val),
            get: fn($val) => strtoupper($val)
        );
    }

    function id ():Attribute {
        return Attribute::make(
            get: fn ($val) => strval($val)
        );
    }


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
