<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Need to enforce that when a comment under a comment is added, it has a parent id.
class Comment extends Model
{
    protected $fillable = [
        'content',
        'commentable_type',
        'commentable_id',
        'parent_id',
        'author_id',
        'edited',
    ];

    use HasFactory;

    

    // Parent comment
    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Reply comments
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Author of comment
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Allows morphing to any commentable resource
    public function commentable() {
        return $this->morphTo();
    }
}
