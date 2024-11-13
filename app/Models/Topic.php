<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    protected $fillable = ['user_id', 'category_id', 'img', 'title', 'content', 'likes_count', 'dislikes_count'];

    public function category()
    {
        return $this->belongsTo(TopicCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(TopicLike::class);
    }

    public function dislikes()
    {
        return $this->hasMany(TopicDislike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'topic_tag');
    }
}
