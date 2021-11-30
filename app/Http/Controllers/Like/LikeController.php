<?php

namespace App\Http\Controllers\Like;

use Illuminate\Http\Request;
use App\Models\Like\Like;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function likePost($id)
    {
        $this->handleLike('App\Models\Post\Post', $id);
    }

    public function likeComment($id)
    {
        $this->handleLike('App\Models\Comment\Comment', $id);
    }

    public function handleLike($type, $id)
    {
        $user = auth()->user();
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId($user->id)->first();

        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => $user->id,
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
            echo "You like this ";
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                echo 'You dislike this ';
            } else {
                $existing_like->restore();
                echo "You like this";
            }
        }
    }
}
