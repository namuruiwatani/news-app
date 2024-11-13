<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($id)
    {
        $topic = Topic::with('comments')->findOrFail($id);
        return view('client.topics.show', compact('topic'));
    }


    public function store(Request $request, $topic_id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->topic_id = $topic_id;
        $comment->content = $request->input('content');
        $comment->original_content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
