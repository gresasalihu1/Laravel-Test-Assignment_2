<?php

namespace App\Http\Controllers\Like;

use Illuminate\Http\Request;
use App\Models\Like\Like;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Models\Comment\Comment;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
        return $this->handleLike($post, $post->id);
    }

    public function likeComment(Comment $comment)
    {
        return $this->handleLike($comment, $comment->id);
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
            return $this->success('You like this');
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                return $this->success('You dislike this');
            } else {
                $existing_like->restore();
                return $this->success('You like this');
            }
        }
    }
}
