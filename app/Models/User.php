<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_TRUSTED = 'trusted';
    const ROLE_USER = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function follow($target) {
        $this->following()->attach($target, ['created_at' => now()]);
    }

    // Comments user has made
    public function comments() {
        return $this->hasMany(Comment::class, 'author_id');
    }

    // Topics user has made
    public function topics(){
        return $this->hasMany(Topic::class, 'author_id');
    }

    // Articles user has made
    public function articles() {
        return $this->hasMany(Article::class, 'author_id');
    }

    // Profile of user
    public function profile() {
        return $this->hasOne(Profile::class, 'user_id');
    }

    // Users that this user follows
    public function following() {
        return $this->belongsToMany(User::class,
        'user_user',
        'follower_id',
        'following_id');
    }

    // Users following this user
    public function followers() {
        return $this->belongsToMany(User::class,
            'user_user',
            'following_id',
            'follower_id');
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTrusted() {
        return $this->role === self::ROLE_TRUSTED;
    }
}
