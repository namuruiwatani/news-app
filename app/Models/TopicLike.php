<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicLike extends Model
{
    protected $fillable = ['user_id', 'topic_id'];
}