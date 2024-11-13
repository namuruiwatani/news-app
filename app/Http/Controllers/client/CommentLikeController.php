<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\CommentDislike;

class CommentLikeController extends Controller
{
    public function like(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $user_id = auth()->user()->id;
    
        $like = CommentLike::where('comment_id', $comment->id)
            ->where('user_id', $user_id)
            ->first();
    
        if ($like) {
            $like->where('comment_id', $comment->id)
            ->where('user_id', $user_id)
            ->delete();
            $comment->decrement('like_count');
        } else {
            $comment->increment('like_count');
            CommentLike::create(['comment_id' => $comment->id, 'user_id' => $user_id]);
    
            $dislike = CommentDislike::where('comment_id', $comment->id)
                ->where('user_id', $user_id)
                ->first();
    
            if ($dislike) {
                $dislike->where('comment_id', $comment->id)
                ->where('user_id', $user_id)
                ->delete();
                $comment->decrement('dislike_count');
            }
        }
    
        return redirect()->back();
    }
    
    public function dislike(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $user_id = auth()->user()->id;
    
        $dislike = CommentDislike::where('comment_id', $comment->id)
            ->where('user_id', $user_id)
            ->first();
    
        if ($dislike) {
            $dislike->where('comment_id', $comment->id)
            ->where('user_id', $user_id)
            ->delete();
            $comment->decrement('dislike_count');
        } else {
            $comment->increment('dislike_count');
            CommentDislike::create(['comment_id' => $comment->id, 'user_id' => $user_id]);

            $like = CommentLike::where('comment_id', $comment->id)
                ->where('user_id', $user_id)
                ->first();

            if ($like) {
                $like->where('comment_id', $comment->id)
                ->where('user_id', $user_id)
                ->delete();
                $comment->decrement('like_count');
            }
        }
    
        return redirect()->back();
    }    
}
