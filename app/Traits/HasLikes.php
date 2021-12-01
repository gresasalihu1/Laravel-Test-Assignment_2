<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\User;

/**
 * Trait ApiResponse.
 */
trait HasLikes
{
    public function likes()
    {
        return $this->morphToMany(User::class, 'likeab
        le')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(auth()->id())->first();
        return (!is_null($like)) ? true : false;
    }
}
