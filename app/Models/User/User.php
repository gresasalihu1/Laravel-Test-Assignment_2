<?php

namespace App\Models\User;

use App\Traits\UserAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment\Comment;
use App\Models\Post\Post;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens, UserAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function likedPosts()
    {
        return $this->morphedByMany(Post::class, 'likeable')->whereDeletedAt(null);
    }

    public function likedComments()
    {
        return $this->morphedByMany(Comment::class, 'likeable')->whereDeletedAt(null);
    }
}
