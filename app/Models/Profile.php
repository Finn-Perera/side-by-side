<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio',
        'location',
        'latitude',
        'longitude',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
