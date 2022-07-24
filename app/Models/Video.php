<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function Thumbnail(): Attribute
    {
        return  Attribute::make(
            get: function ($value, $attributes) {
                $dist = 'public/videos/' . $attributes['uid'] . '/' . $attributes['uid']  . '.png';
                if (Storage::exists($dist)) {
                    return Storage::url($dist);
                }
            },
        );
    }

    public function PlayerPath(): Attribute
    {
        return  Attribute::make(
            get: function ($value, $attributes) {
                $dist = 'public/videos/' . $attributes['uid'] . '/' . $attributes['uid']  . '.m3u8';
                if (Storage::exists($dist)) {
                    return Storage::url($dist);
                }
            },
        );
    }

    public function CreatedAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $date =  new Carbon($value);
                return $date->toFormattedDateString();
            },
        );
    }


    public function liked(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->Likes()->whereUserId(auth()->id())->exists();
            },
        );
    }

    public function disLiked(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->DisLikes()->whereUserId(auth()->id())->exists();
            },
        );
    }

    /**
     * return count of all comments
     *
     * @return int
     */
    public function commentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }

    public function Channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function Likes()
    {
        return $this->hasMany(Like::class);
    }

    public function DisLikes()
    {
        return $this->hasMany(DisLike::class);
    }

    /**
     * Get all of the comments for the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id');
    }
}
