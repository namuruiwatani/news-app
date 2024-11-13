<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_tag');
    }
}

