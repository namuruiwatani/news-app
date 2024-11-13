<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicLike;
use App\Models\TopicDislike;

class TopicLikeController extends Controller
{
    public function like(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $user_id = auth()->user()->id;

        $dislike = TopicDislike::where('topic_id', $topic->id)
                                ->where('user_id', $user_id)
                                ->first();

        if ($dislike) {
            $dislike->delete();
            $topic->dislikes_count--;
        }

        $like = TopicLike::where('topic_id', $topic->id)
                            ->where('user_id', $user_id)
                            ->first();

        if (!$like) {
            $topic->likes_count++;
            $topic->save();
            TopicLike::create(['topic_id' => $topic->id, 'user_id' => $user_id]);
        }

        return redirect()->back();
    }

    public function dislike(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $user_id = auth()->user()->id;

        $like = TopicLike::where('topic_id', $topic->id)
                            ->where('user_id', $user_id)
                            ->first();

        if ($like) {
            $like->delete();
            $topic->likes_count--;
        }

        $dislike = TopicDislike::where('topic_id', $topic->id)
                                ->where('user_id', $user_id)
                                ->first();

        if (!$dislike) {
            $topic->dislikes_count++;
            $topic->save();
            TopicDislike::create(['topic_id' => $topic->id, 'user_id' => $user_id]);
        }

        return redirect()->back();
    }
}
