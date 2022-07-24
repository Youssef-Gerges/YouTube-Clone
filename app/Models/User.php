<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * Get all of the likes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get all of the disLikes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disLikes(): HasMany
    {
        return $this->hasMany(DisLike::class);
    }


    public function Channel()
    {
        return $this->hasOne(Channel::class);
    }

    /**
     * Get all of the subscribtions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribedChannels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, 'subscribers', 'user_id');
    }

    /**
     * Get all of the subscribtions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscribtions(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
