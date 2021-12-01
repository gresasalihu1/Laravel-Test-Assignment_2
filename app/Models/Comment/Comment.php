<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\Traits\HasLikes;

class Comment extends Model
{
    use HasFactory, HasLikes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($comment) {
            $comment->user_id = auth()->user()->id;
        });
    }
}
