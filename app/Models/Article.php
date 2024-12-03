<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Comments under article
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Topic article relates to
    public function topic() {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    // Author of article
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
