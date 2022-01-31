<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The different types of users
     *
     * @var array
     */
    const TYPE = ['admin' => "administrator", 'basic' => 'basic'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($user) {
            $user->uuid = (string) Str::uuid(); // Create uuid
        });
    }

    /**
     * Get the post of the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get administrator user
     * @return \App\Models\User
     */
    public static function getAdministratorUser()
    {
        return User::where('type', User::TYPE['admin'])->first();
    }
}
