<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
