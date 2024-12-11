<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'edited',
    ];

    // Topic article relates to
    public function topic() {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    // Author of article
    public function author() {
        return $this->belongsTo(User::class,'author_id');
    }

    // Comments under article
    public function parentComments() { 
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function allComments() { 
        return $this->morphMany(Comment::class, 'commentable');
    }
}
