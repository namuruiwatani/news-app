<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicDislike extends Model
{
    protected $fillable = ['user_id', 'topic_id'];
}