<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'content',
        'original_content',
        'approval_status',
        'like_count',
        'dislike_count',
    ];

    public const APPROVAL_UNDECIDED = 'undecided';
    public const APPROVAL_APPROVED = 'approved';
    public const APPROVAL_REJECTED = 'rejected';

    protected static $censorWord = 'мат';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            $comment->original_content = $comment->content;
            $comment->content = static::censorText($comment->content);
        });
    }

    protected static function censorText($text)
    {
        return str_contains($text, static::$censorWord) ? str_replace(static::$censorWord, '***', $text) : $text;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function dislikes()
    {
        return $this->hasMany(CommentDislike::class);
    }
}
