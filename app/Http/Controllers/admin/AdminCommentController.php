<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function show($id)
    {
        $topic = Topic::with('comments')->findOrFail($id);
        return view('admin.topics.show', compact('topic'));
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

    public function approve($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->approval_status = Comment::APPROVAL_APPROVED;
        $comment->content = $comment->original_content;
        $comment->save();

        return redirect()->back()->with('success', 'Comment approved successfully!');
    }


    public function reject($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->approval_status = Comment::APPROVAL_REJECTED;
        $comment->save();

        return redirect()->back()->with('success', 'Comment rejected successfully!');
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
