<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'edited',
    ];

    // Articles relating to topic
    public function articles() {
        return $this->hasMany(Article::class, 'topic_id');
    }

    // Author of topic
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Comments under article
    public function parentComments() { 
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function allComments() { 
        return $this->morphMany(Comment::class, 'commentable');
    }
}
