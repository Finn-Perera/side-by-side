<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function comments() {
        return $this->hasMany(Comment::class, 'commentable');
    }

    public function topic() {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
