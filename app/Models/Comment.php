<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Need to enforce that when a comment under a comment is added, it has a parent id.
class Comment extends Model
{
    // Allows comments on comments
    public function commentable() {
        return $this->morphTo();
    }

    // Reply comments
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Parent comment
    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Author of comment
    public function user() {
        return $this->belongsTo(User::class);
    }
}
