<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Storage::url($value);
            },
        );
    }


    public function subscribed(): Attribute
    {
        return new Attribute(
            get: fn () => $this->subscribers()->whereUserId(auth()->id())->exists(),
        );
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get all of the subscribers for the Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }
}
