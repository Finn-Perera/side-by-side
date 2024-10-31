<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Need to enforce that when a comment under a comment is added, it has a parent id.
class Comment extends Model
{
    use HasFactory;

    // Reply comments
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Parent comment
    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function article() {
        return $this->belongsTo(Article::class,'article_id');
    }

    // Author of comment
    public function user() {
        return $this->belongsTo(User::class);
    }
}
